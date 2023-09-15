<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use App\Notifications\ChatroomNotification;
use App\Notifications\FriendshipNotification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use const http\Client\Curl\AUTH_ANY;

class FriendController extends Controller
{

    public function index(): View {
        return view('friends', [
            'friends' => Friendship::where(['person1' => Auth::id()])->orWhere(['person2' => Auth::id()])->get(),
            'suggestions' => FriendController::getSuggestions(),
        ]);
    }

    public static function getSuggestions(): Collection {
        return User::all()->where('id', '!=', Auth::id())->take(5);
    }

    public function add(int $person1, int $person2): RedirectResponse {
        $query = Friendship::where('person1', $person1)->where('person2', $person2);
        if(!$query->exists() && $person1 == Auth::id()) {
            $friendship = new Friendship();
            $friendship->person1 = $person1;
            $friendship->person2 = $person2;
            $friendship->save();
            $user = User::where('id', $person2)->first();
            $user->notify(new FriendshipNotification($person1, 'request'));
            return redirect()->back()->with('message', 'You just requested ' . User::find($person2) . ' as a friend.');
        }
        return redirect()->back()->with('message', 'You cannot do this operation.');
    }

    public function acceptFriend(Friendship $friendship): RedirectResponse {
        if($friendship->person1 != Auth::id()) {
            $friendship->status = 'confirmed';
            $friendship->save();
            $user1 = User::where('id', $friendship->person2)->first();
            $user2 = User::where('id', $friendship->person1)->first();
            $user1->notify(new FriendshipNotification($friendship->person1, 'confirmed'));
            $user2->notify(new FriendshipNotification($friendship->person2, 'confirmed'));
            return redirect()->back()->with('success', 'You just accepted this new friend.');
        }
        return redirect()->back()->with('wrong', 'You are not able to accept this person.');
    }

    public function remove(int $person1, int $person2): RedirectResponse {
        $friendship = Friendship::where(function ($query) use ($person1, $person2) {
            $query->where('person1', $person1)
                ->where('person2', $person2);
        })->orWhere(function ($query) use ($person1, $person2) {
            $query->where('person1', $person2)
                ->where('person2', $person1);
        })->first();
        if(($person1 == Auth::id() || $person2 == Auth::id()) && $friendship->count() > 0) {
            $friendship->delete();
            return redirect()->back()->with('success', 'You just removed ' . User::find($person2)->name . ' as a friend.');
        }
        return redirect()->back()->with('wrong', 'You cannot do this operation.');
    }
}
