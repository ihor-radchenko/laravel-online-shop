
@isset($reviews)
    @foreach($reviews as $review)
        <div class="review">
            <div class="title color-black">{{ $review->title }}</div>
            <div class="rating">
                @for($i = 1; $i <= 5; $i++)
                    <span class="glyphicon glyphicon-star{{ ($i <= $review->rating) ? '' : '-empty'}}"></span>
                @endfor
            </div>
            <div class="content">
                {{ $review->text }}
            </div>
            <div class="info">
                <span class="author color-black"><b>{{ $review->user->name or $review->name }}</b></span> @lang('page.write') {{ $review->created_at->format('j/n/y H:i:s') }}
            </div>
        </div>
        <hr>
    @endforeach
@endisset