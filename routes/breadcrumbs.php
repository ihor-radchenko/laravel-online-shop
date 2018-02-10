<?php

Breadcrumbs::register('main', function ($breadcrumbs) {
    $breadcrumbs->push(Lang::get('breadcrumbs.main'), route('main'));
});

Breadcrumbs::register('blog', function ($breadcrumbs) {
    $breadcrumbs->parent('main');
    $breadcrumbs->push(Lang::get('breadcrumbs.blog'), route('blog'));
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
        $breadcrumbs->parent('main');
        $breadcrumbs->push($category->title, route('products.index', $category->alias));
    }
});

Breadcrumbs::register('product', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('products', $product->category);
    $breadcrumbs->push($product->title, route('product', ['id' => $product->id]));
});