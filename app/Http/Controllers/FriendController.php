<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public static function getSuggestions(): Collection {
        return User::all()->where('id', '!=', Auth::id())->take(5);
    }
}
