
<h2 class="text-center color-black">@lang('page.from_blog')</h2>

<div class="container">
    <div class="row">
        @isset($articles)
            @foreach($articles as $article)
                <div class="col-sm-4">
                    <div class="thumbnail post-item">
                        <div class="post-img">
                            <img src="{{ asset($article->img) }}" alt="">
                        </div>
                        <div class="caption">
                            <a href="{{ route('article', ['article' => $article->alias]) }}" class="link-post">{{ $article->title }}</a>
                            <p class="description hidden-xs">
                                {{ str_limit($article->text) }}
                            </p>
                            <div class="post-data">
                                <div class="create-data">
                                    <i class="fa fa-calendar" aria-hidden="true"></i> {{ $article->created_at->format('M j, Y') }}
                                </div>
                                <div class="author">
                                    <i class="fa fa-user-o" aria-hidden="true"></i> by {{ $article->user->name }}
                                </div>
                                <div class="comments">
                                    <i class="fa fa-comment-o" aria-hidden="true"></i> {{ $article->comments_count }}
                                </div>
                            </div>
                            <a href="{{ route('article', ['article' => $article->alias]) }}" class="my-btn btn-white">@lang('button.show')</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endisset
    </div>
</div>