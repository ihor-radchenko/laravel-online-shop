
<h2 class="text-center color-black">
    Из блога
</h2>

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
                            <a href="/blog/{{ $article->alias }}" class="link-post">{{ $article->title }}</a>
                            <p class="description hidden-xs">
                                {{ $article->shortText }}
                            </p>
                            <div class="post-data">
                                <div class="create-data">
                                    <i class="fa fa-calendar" aria-hidden="true"></i> {{ $article->created }}
                                </div>
                                <div class="author">
                                    <i class="fa fa-user-o" aria-hidden="true"></i> by {{ $article->user->name }}
                                </div>
                                <div class="comments">
                                    <i class="fa fa-comment-o" aria-hidden="true"></i> 2
                                </div>
                            </div>
                            <a href="/blog/{{ $article->alias }}" class="my-btn btn-white">Прочесть</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endisset
    </div>
</div>