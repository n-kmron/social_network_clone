<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\User;

class AuthController extends Controller
{

    public function index() {
        return view('login', [
            'posts' => AuthController::getPosts()
        ]);
    }
    public function login()
    {
        Auth::attempt([
            'email' => $_POST["email"],
            'password' => $_POST["psw"]
        ]);
        session()->regenerate();
        $this->index();
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }

    public function register()
    {
        try {
            User::create([
                'name' => $_POST["matricule"],
                'displayName' => $_POST["matricule"],
                'email' => $_POST["email"],
                'password' => Hash::make($_POST["psw"])
            ]);
            AuthController::login();
            $this->index();
        } catch (QueryException $e) {
            // Duplicate entry for email field
            if ($e->getCode() === '23000' && strpos($e->getMessage(), 'users_email_unique') !== false) {
                echo '<script type="text/javascript">
                                        alert("This account is already registered");
                                        </script>';
                return view('login');
            }
            echo '<script type="text/javascript">
                                        alert("This account is already registered");
                                        </script>';
            $this->index();
        }
    }

    public function getPosts() {
        return Post::where('owner', Auth::id())->get();
    }
}
