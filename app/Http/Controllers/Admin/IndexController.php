<?php

namespace AutoKit\Http\Controllers\Admin;

use Illuminate\Http\Request;
use AutoKit\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.main');
    }
}
