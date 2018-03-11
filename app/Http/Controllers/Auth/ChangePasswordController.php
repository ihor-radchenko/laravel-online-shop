<?php

namespace AutoKit\Http\Controllers\Auth;

use AutoKit\Http\Controllers\Controller;
use AutoKit\Http\Requests\ChangePasswordRequest;
use Hash;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('auth.passwords.change');
    }

    public function update(ChangePasswordRequest $request)
    {
        $request->user()->fill([
            'password' => Hash::make($request->password)
        ])->save();
        return back();
    }
}
