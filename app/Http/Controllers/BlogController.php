<?php

namespace AutoKit\Http\Controllers;

use AutoKit\Article;
use AutoKit\Comment;
use AutoKit\Menu;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view(
            'blog',
            [
                'menu_navigation' => Menu::with('categories')->get(),
                'articles' => Article::with('user')->withCount('comments')->orderByDesc('id')->get()
            ]
        );
    }

    public function show(string $alias)
    {
        return view(
            'post',
            [
                'menu_navigation' => Menu::with('categories')->get(),
                'article' => Article::whereAlias($alias)->withCount('comments')->with('user')->first(),
                'comments' => Comment::whereArticleId(Article::whereAlias($alias)->first()->id)->with('user')->get()
            ]
        );
    }
}
