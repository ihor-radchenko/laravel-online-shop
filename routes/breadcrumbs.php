<?php

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Главная', route('home'));
});

Breadcrumbs::register('blog', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Блог', route('blog'));
});

Breadcrumbs::register('article', function ($breadcrumbs, $article) {
    $breadcrumbs->parent('blog');
    $breadcrumbs->push($article->title, route('article', $article->alias));
});

Breadcrumbs::register('products', function ($breadcrumbs, $category) {
    if ($category->menu) {
        $breadcrumbs->parent('products', $category->menu);
        $breadcrumbs->push(
            $category->title,
            route('products.category', ['parent_category' => $category->menu->alias, 'category' => $category->alias])
        );
    } else {
        $breadcrumbs->parent('home');
        $breadcrumbs->push($category->title, route('products.index', $category->alias));
    }
});