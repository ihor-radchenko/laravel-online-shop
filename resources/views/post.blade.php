
@extends('layouts.master')

@section('content')
    {{ Breadcrumbs::render('article', $article) }}
    <div class="container">
        <div class="row">
            @isset($article)
                <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                    <div class="post">
                        <div class="post-title">{{ $article->title }}</div>
                        <div class="post-data">
                            <div class="create-data">
                                <i class="fa fa-calendar" aria-hidden="true"></i> {{ $article->created_at->format('M j, Y') }}
                            </div>
                            <div class="author">
                                <i class="fa fa-user-o" aria-hidden="true"></i> by {{ $article->user->name }}
                            </div>
                            <div class="comments">
                                <i class="fa fa-comment-o" aria-hidden="true"></i> {{ $article->comments->count() }}
                            </div>
                        </div>
                        <div class="post-image">
                            <img src="{{ asset($article->img) }}" alt="" class="img-responsive">
                        </div>
                        <div class="post-content">
                            {{ $article->text }}
                        </div>
                    </div>
                    <hr>
                    @include('templates.comments')
                </div>
            @endisset
        </div>
    </div>
@endsection