
<div class="comments">
    <div class="comments-title"><h4 class="color-black">Добавте коментарий</h4></div>
    @isset($comments)
        @foreach($comments as $comment)
            <div class="comment">
                <div class="info">
                    <span class="author">{{ $comment->user->name or $comment->name }}</span> написал {{ $comment->created_at->format('M j, Y H:i:s') }}
                </div>
                <div class="content">
                    {{ $comment->text }}
                </div>
            </div>
            <hr>
        @endforeach
        @if($comments->isEmpty())
            <h4 class="color-black text-center">Коментариев еще нету</h4>
        @endif
    @endisset
    <div class="comment-add">
        <h4 class="color-black">Оставте ответ</h4>
        <form action="">
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" class="form-control" id="name" required minlength="2" maxlength="255">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" required minlength="5" maxlength="255">
            </div>
            <div class="form-group">
                <label for="comment">Коментарий</label>
                <textarea name="text" id="comment" cols="30" rows="5" class="form-control" required></textarea>
            </div>
            <button type="submit" class="my-btn btn-black">Добавить</button>
        </form>
    </div>
</div>