<?php

namespace AutoKit\Http\Controllers\Auth;

use Auth;
use AutoKit\Events\ConfirmEmail;
use AutoKit\User;
use Illuminate\Http\Request;
use AutoKit\Http\Controllers\Controller;
use Lang;

class EmailConfirmController extends Controller
{
    public function confirmEmail(User $user)
    {
        Auth::login($user->confirmEmail());
        event(new ConfirmEmail($user));
        return view('home');
    }
}
