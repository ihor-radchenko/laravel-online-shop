
<div class="comments">
    <div class="comments-title"><h4 class="color-black">@lang('page.comments_head')</h4></div>
    <div class="forAddComment"></div>
    @isset($comments)
        @if($comments->isEmpty())
            <h4 class="color-black text-center">@lang('page.comments_empty')</h4>
        @else
            <div class="comments-list">
                @include('partials.article.comments_list')
            </div>
        @endif
    @endisset

    <div class="center-container">
        <button class="my-btn btn-black" id="showMoreComments" data-route="{{ route('article', ['article' => $article->alias]) }}" data-load="@lang('button.load')" data-text="@lang('button.show_more')">
            @lang('button.show_more')
        </button>
    </div>

    <div class="comment-add">
        <h4 class="color-black">@lang('page.comments_add')</h4>
        <form action="{{ route('comment.store') }}" id="formCreateComment">
            <div class="form-group" id="group-name">
                <label for="name" class="control-label">@lang('form.name')</label>
                <input type="text" class="form-control" id="name" required minlength="2" maxlength="255"
                    @auth
                        value="{{ Auth::user()->name }}" disabled
                    @endauth
                >
                <ul class="help-block"></ul>
            </div>
            <div class="form-group" id="group-email">
                <label for="email" class="control-label">@lang('form.email')</label>
                <input type="email" class="form-control" id="email" required maxlength="255"
                    @auth
                        value="{{ Auth::user()->email }}" disabled
                    @endauth
                >
                <ul class="help-block"></ul>
            </div>
            <div class="form-group" id="group-text">
                <label for="text" class="control-label">@lang('form.comment')</label>
                <textarea name="text" id="text" cols="30" rows="5" class="form-control" required></textarea>
                <ul class="help-block"></ul>
            </div>
            {{ csrf_field() }}
            <input type="hidden" name="article_id" value="{{ $article->id }}" id="articleId">
            <button type="submit" class="my-btn btn-black" data-text="@lang('form.send')" data-load="@lang('form.sending')" id="createComment">
                @lang('form.send')
            </button>
        </form>
    </div>
</div>
@include('partials.ajax.message')