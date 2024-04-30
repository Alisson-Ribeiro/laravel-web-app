<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


    //yet to implement => Password Reset and rate limiting 'how many times a user can attempt to log in'

class SessionController extends Controller
{
    public function create()
    {
    return view('auth/login');
    }

    public function store()
    {
        // validate
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // attempt to login the user
        if (! Auth::attempt($attributes))
        {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match.'
            ]);
        }

        // regenarete the session token
        request()->session()->regenerate();

        // redirect
        return redirect('/jobs');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
