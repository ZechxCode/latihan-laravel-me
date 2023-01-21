<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;

class UserController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function StoreLogin(LoginRequest $loginRequest)
    {
        $payload = $loginRequest->validated();
        $user = User::where('email', $payload['email'])->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        if (Hash::check($payload['password'], $user->password)) {
            Auth::login($user);
            return redirect('/');
        }
        return redirect()->back()->with('error', 'Invalid Credentials');
    }

    public function Logout()
    {
        $user = auth()->user();
        Auth::logout();
        return redirect('/login');
    }
}
