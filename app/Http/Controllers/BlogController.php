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

    public function show(Request $request, Article $article)
    {
        if ($request->ajax()) {
            return view('partials.article.comment', ['comments' => $this->comment->getForArticle($article, $request->page)]);
        }
        return view(
            'post',
            [
                'article' => $article->load('user'),
                'comments' => $this->comment->getForArticle($article),
                'maxOffset' => $this->comment->getMaxOffset($article)
            ]
        );
    }
}
