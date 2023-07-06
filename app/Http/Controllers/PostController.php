<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{

    public function index(): View {
        return view('homepage', [
            'posts' => Post::paginate(5)
        ]);
    }
    public function create() {
        return view('create');
    }

    public function store(CreatePostRequest $request) {
        Post::create($request->validated());
        return redirect()->route('index')->with('success', "Your post has been created");
    }

    public function edit(Post $post) {
        return view('edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post, CreatePostRequest $request) {
        $post->update($request->validated());
        return redirect()->route('index')->with('success', "Your post has been edited");
    }
}
