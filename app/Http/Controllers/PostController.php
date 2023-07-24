<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{

    public function index(): View {
        return view('homepage', [
            'posts' => Post::orderBy('updated_at', 'desc')->paginate(5),
            'suggestions' => FriendController::getSuggestions(),
        ]);
    }
    public function create(): View {
        $post = new Post();
        $post->name = 'New post';
        $post->content = 'Content';
        return view('create', [
            'post' => $post,
            'suggestions' => FriendController::getSuggestions()
        ]);
    }

    public function store(FormPostRequest $request): RedirectResponse {
        if($request->validated('owner') == Auth::id()) {
            Post::create($this->extractData(new Post(), $request));
            return redirect()->route('index')->with('success', "Your post has been created");
        }
        return abort(401);
    }

    public function edit(Post $post): View|RedirectResponse {
        if($post->owner == Auth::id()) {
            return view('edit', [
                'post' => $post,
                'suggestions' => FriendController::getSuggestions()
            ]);
        }
        return abort(401);
    }

    public function delete(Post $post): RedirectResponse{
        if($post->owner == Auth::id()) {
            if($post->picture_link) {
                Storage::disk('public')->delete($post->picture_link);
            }
            $post->delete();
            return redirect()->route('index')->with('success', "Your post has been deleted");
        }
        return abort(401);
    }

    public function update(Post $post, FormPostRequest $request): RedirectResponse {
        if($request->validated('owner') == Auth::id()) {
            $post->update($this->extractData($post, $request));
            return redirect()->route('index')->with('success', "Your post has been edited");
        }
        return abort(401);
    }

    private function extractData(Post $post, FormPostRequest $request): array {
        $data = $request->validated();

        /** @var UploadedFile|null $image */
        $image = $request->validated('picture_link');
        if($image === null || $image->getError()) {
            return $data;
        }
        if($post->picture_link) {
            Storage::disk('public')->delete($post->picture_link);
        }
        $folder = 'posts/' . Auth::id();
        $data['picture_link'] = $image->store($folder, 'public');
        return $data;
    }

    public static function getPosts($id) {
        return Post::where('owner', $id)->get();
    }
}
