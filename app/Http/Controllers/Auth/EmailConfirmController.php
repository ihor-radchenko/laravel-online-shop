<?php

namespace AutoKit\Http\Controllers\Auth;

use Auth;
use AutoKit\User;
use Illuminate\Http\Request;
use AutoKit\Http\Controllers\Controller;

class EmailConfirmController extends Controller
{
    public function confirmEmail(User $user)
    {
        Auth::login($user->confirmEmail());
        return view('home');
    }
}
