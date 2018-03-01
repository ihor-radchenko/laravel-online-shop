<?php

namespace AutoKit\Http\Controllers;

use Auth;
use AutoKit\Http\Requests\ReviewRequest;
use AutoKit\Review;
use Illuminate\Http\Request;
use Lang;

class ReviewController extends Controller
{
    /**
     * @param ReviewRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(ReviewRequest $request)
    {
        $review = Auth::check()
            ? $request->user()->reviews()->create($request->all())
            : Review::create($request->all());
        return response()->json([
            'content' => view('partials.product.review')
                ->with('review', $review)
                ->render(),
            'message' => Lang::get('ajax.add-review', ['name' => $request->name])
        ]);
    }
}