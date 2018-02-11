<?php

namespace AutoKit\Http\Controllers;

use Auth;
use AutoKit\Http\Requests\ReviewRequest;
use AutoKit\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(ReviewRequest $request)
    {
        $review = Auth::check()
            ? $request->user()->reviews()->create($request->all())
            : Review::create($request->all());
        return view('partials.product.review', ['review' => $review]);
    }
}