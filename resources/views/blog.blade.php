
@extends('layouts.master')

@section('content')
    {{ Breadcrumbs::render('blog') }}
    <h2 class="text-center color-black">Блог</h2>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                @isset($articles)
                    @foreach($articles as $article)
                        <div class="post">
                            <div class="post-title">
                                <a href="{{ route('article', ['alias' => $article->alias]) }}" class="color-black">{{ $article->title }}</a>
                            </div>
                            <div class="post-image">
                                <img src="{{ asset($article->img) }}" alt="" class="img-responsive post-img">
                            </div>
                            <div class="post-short-content">
                                {{ str_limit($article->text) }}
                            </div>
                            <div class="post-data">
                                <div class="create-data">
                                    <i class="fa fa-calendar" aria-hidden="true"></i> {{ $article->created_at->format('M j, Y') }}
                                </div>
                                <div class="author">
                                    <i class="fa fa-user-o" aria-hidden="true"></i> by {{ $article->user->name }}
                                </div>
                                <div class="comments">
                                    <i class="fa fa-comment-o" aria-hidden="true"></i> 2
                                </div>
                            </div>
                            <div class="for-button">
                                <a href="{{ route('article', ['alias' => $article->alias]) }}" class="my-btn btn-white">Прочесть</a>
                            </div>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>
@endsection