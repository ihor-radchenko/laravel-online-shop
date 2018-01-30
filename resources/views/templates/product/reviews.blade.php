
<div class="reviews">
    <h3 class="color-black">
        Отзывы покупателей
    </h3>
    @isset($product)
        @foreach($product->reviews as $review)
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
                    <span class="author color-black"><b>{{ $review->user->name or $review->name }}</b></span> написал {{ $review->created_at->format('j/n/y H:i:s') }}
                </div>
            </div>
            <hr>
        @endforeach
        @if ($product->reviews->isEmpty())
            <h4 class="color-black text-center">Отзывов еще нету</h4>
        @endif
    @endisset
    <div class="add-review">
        <h3 class="color-black">
            Напишите свой отзыв
        </h3>
        <form action="">
            <div class="form-group">
                <div class="stars">
                    <div class="star-cont">
                        <input class="star star-5" id="star-5" type="radio" name="rating" value="5"/>
                        <label class="star star-5" for="star-5"></label>
                        <input class="star star-4" id="star-4" type="radio" name="rating" value="4"/>
                        <label class="star star-4" for="star-4"></label>
                        <input class="star star-3" id="star-3" type="radio" name="rating" value="3"/>
                        <label class="star star-3" for="star-3"></label>
                        <input class="star star-2" id="star-2" type="radio" name="rating" value="2"/>
                        <label class="star star-2" for="star-2"></label>
                        <input checked class="star star-1" id="star-1" type="radio" name="rating" value="1"/>
                        <label class="star star-1" for="star-1"></label>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" class="form-control" id="name" required minlength="2" maxlength="255">
            </div>
            <div class="form-group">
                <label for="title">Вкратце</label>
                <input type="text" class="form-control" id="title" required maxlength="255">
            </div>
            <div class="form-group">
                <label for="text">Отзыв</label>
                <textarea name="" id="text" rows="4" class="form-control" required></textarea>
            </div>
            <button type="submit" class="my-btn btn-black">Отправить</button>
        </form>
    </div>
</div>