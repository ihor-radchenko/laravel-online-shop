
<div class="comments">
    <div class="comments-title"><h4 class="color-black">@lang('page.comments_head')</h4></div>
    @isset($comments)
        @if($comments->isEmpty())
            <h4 class="color-black text-center">@lang('page.comments_empty')</h4>
        @else
            <div class="comments-list">
                @include('partials.article.comment')
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
        <form action="">
            <div class="form-group">
                <label for="name">@lang('form.name')</label>
                <input type="text" class="form-control" id="name" required minlength="2" maxlength="255">
            </div>
            <div class="form-group">
                <label for="email">@lang('form.email')</label>
                <input type="email" class="form-control" id="email" required minlength="5" maxlength="255">
            </div>
            <div class="form-group">
                <label for="comment">@lang('form.comment')</label>
                <textarea name="text" id="comment" cols="30" rows="5" class="form-control" required></textarea>
            </div>
            <button type="submit" class="my-btn btn-black">@lang('form.send')</button>
        </form>
    </div>
</div>