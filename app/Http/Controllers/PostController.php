<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function create() {
        return view('create');
    }

    public function store(Request $request) {
        try {
            Post::create([
                'owner' => Auth::id(),
                'name' => $request->input('title'),
                'content' => $request->input('content'),
                'picture_link' => Auth::id() .  '-' . Str::slug($request->input('title')),
                'likes' => 0,
            ]);
        } catch(QueryException $e) {
            $error = "Your post has not been created." . ' Maybe you already have a post with the same title';
            return redirect()->route('index')->with('wrong',  $error);
        }
    return redirect()->route('index')->with('success', "Your post has been created");
    }
}
