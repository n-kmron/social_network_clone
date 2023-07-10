<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPostRequest;
use App\Models\Post;
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
    public function create() {
        $post = new Post();
        $post->name = 'New post';
        $post->content = 'Content';
        return view('create', [
            'post' => $post
        ]);
    }

    public function store(FormPostRequest $request) {
        Post::create($this->extractData(new Post(), $request));
        return redirect()->route('index')->with('success', "Your post has been created");
    }

    public function edit(Post $post) {
        return view('edit', [
            'post' => $post
        ]);
    }

    public function delete(Post $post) {
        if($post->picture_link) {
            Storage::disk('public')->delete($post->picture_link);
        }
        $post->delete();
        return redirect()->route('index')->with('success', "Your post has been deleted");
    }

    public function update(Post $post, FormPostRequest $request) {
        $post->update($this->extractData($post, $request));
        return redirect()->route('index')->with('success', "Your post has been edited");
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
