<?php

namespace AutoKit\Http\Controllers;

use Auth;
use AutoKit\Comment;
use AutoKit\Http\Requests\CommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $comment = Auth::check()
            ? $request->user()->comments()->create($request->all())
            : Comment::create($request->all());
        return view('partials.article.comment', ['comment' => $comment]);
    }
}
