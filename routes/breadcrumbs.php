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

Breadcrumbs::register('products', function ($breadcrumbs, $menu) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($menu->title, route('article', $menu->alias));
});