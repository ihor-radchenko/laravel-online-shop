<?php

namespace AutoKit\Http\Controllers;

use AutoKit\Article;
use AutoKit\Comment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * @var Article
     */
    protected $article;

    /**
     * @var Comment
     */
    protected $comment;

    public function __construct(Article $article, Comment $comment)
    {
        $this->article = $article;
        $this->comment = $comment;
    }

    public function index()
    {
        return view('blog', ['articles' => $this->article->getForBlog()]);
    }

    public function show(Article $article)
    {
        return view(
            'post',
            [
                'article' => $article->load('user'),
                'comments' => $this->comment->getForArticle($article)
            ]
        );
    }
}
