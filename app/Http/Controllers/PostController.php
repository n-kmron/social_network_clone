<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPostRequest;
use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{

    public function index(): View {
        return view('homepage', [
            'posts' => Post::orderBy('updated_at', 'desc')->paginate(5)
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
        Post::create($request->validated());
        return redirect()->route('index')->with('success', "Your post has been created");
    }

    public function edit(Post $post) {
        return view('edit', [
            'post' => $post
        ]);
    }

    public function delete(Post $post) {
        $post->delete();
        return redirect()->route('index')->with('success', "Your post has been deleted");
    }

    public function update(Post $post, FormPostRequest $request) {
        $post->update($request->validated());
        return redirect()->route('index')->with('success', "Your post has been edited");
    }
}
