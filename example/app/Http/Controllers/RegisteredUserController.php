<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\support\facades\Auth;
use Illuminate\validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth/register');
    }

    public function store()
    {
        //validate
        $attributes = request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::default(), 'confirmed'],
        ]);

        //create
        $user = User::create($attributes);

        //log in
        Auth::login($user);

        //redirect
        return redirect('/jobs');
    }
}
