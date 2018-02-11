
@isset($comment)
    <div class="comment">
        <div class="info">
            <span class="author">{{ $comment->user->name or $comment->name }}</span> @lang('page.write') {{ $comment->created_at->format('M j, Y H:i:s') }}
        </div>
        <div class="content">
            {{ $comment->text }}
        </div>
    </div>
    <hr>
@endisset