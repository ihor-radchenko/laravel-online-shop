<?php

namespace AutoKit\Http\Controllers\Auth;

use Auth;
use AutoKit\User;
use Illuminate\Http\Request;
use AutoKit\Http\Controllers\Controller;
use Lang;

class EmailConfirmController extends Controller
{
    public function confirmEmail(User $user)
    {
        Auth::login($user->confirmEmail());
        session()->flash('message', Lang::get('flash.confirm_success'));
        return view('home');
    }
}
