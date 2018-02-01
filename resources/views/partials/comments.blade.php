
<div class="comments">
    <div class="comments-title"><h4 class="color-black">@lang('page.comments_head')</h4></div>
    @isset($comments)
        @foreach($comments as $comment)
            <div class="comment">
                <div class="info">
                    <span class="author">{{ $comment->user->name or $comment->name }}</span> @lang('page.write') {{ $comment->created_at->format('M j, Y H:i:s') }}
                </div>
                <div class="content">
                    {{ $comment->text }}
                </div>
            </div>
            <hr>
        @endforeach
        @if($comments->isEmpty())
            <h4 class="color-black text-center">@lang('page.comments_empty')</h4>
        @endif
    @endisset
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