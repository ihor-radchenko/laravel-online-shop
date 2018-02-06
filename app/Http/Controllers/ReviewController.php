<?php

namespace AutoKit\Http\Controllers;

use AutoKit\Http\Requests\ReviewRequest;
use AutoKit\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(ReviewRequest $request)
    {
        return view('partials.ajax.review', ['review' => Review::create($request->all())]);
    }
}
