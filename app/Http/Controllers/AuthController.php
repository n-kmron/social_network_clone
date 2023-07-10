<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Models\User;
use Illuminate\View\View;

class AuthController extends Controller
{

    public function index(): View {
        $posts = PostController::getPosts(Auth::id());
        return view('login', [
            'posts' => $posts,
        ]);
    }
    public function login(LoginRequest $request): View|RedirectResponse
    {
        $credentials = $request->validated();
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->index();
        }
        return to_route('auth.login')->withErrors([
            'email' => 'Email or password invalid'
        ])->onlyInput('email');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }

    public function register(RegisterRequest $request): RedirectResponse|View
    {
        try {
            $credentials = $request->validated();
            User::create($credentials);
            return redirect()->route('auth.login')->with('success', "Your account has been created");
        } catch (QueryException $e) {
            echo '<script type="text/javascript">
                                        alert("This account is already registered");
                                        </script>';
            return $this->index();
        }
    }
}
