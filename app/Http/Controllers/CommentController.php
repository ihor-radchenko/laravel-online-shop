<?php

namespace AutoKit\Http\Controllers;

use Auth;
use AutoKit\Comment;
use AutoKit\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use Lang;

class CommentController extends Controller
{
    /**
     * @param CommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(CommentRequest $request)
    {
        $comment = Auth::check()
            ? $request->user()->comments()->create($request->all())
            : Comment::create($request->all());
        return response()->json([
            'content' => view('partials.article.comment', ['comment' => $comment])->render(),
            'message' => Lang::get('ajax.add-comment', ['name' => $request->name])
        ]);
    }
}
