
<h2 class="text-center color-black">
    Новинки
</h2>

<div class="container">
    <div class="row">
        @isset($new_products)
            @foreach($new_products as $product)
                @if($product->is_new === 1)
                    <div class="col-sm-6 col-md-3">
                        <a href="" class="thumbnail product-show">
                            <span class="new">New</span>
                            <div class="img-wrapper">
                                <img src="{{ asset($product->img) }}" alt="">
                            </div>
                            <div class="caption">
                                @if(! is_null($product->old_price))
                                    <span class="new-price">${{ $product->price }}</span>
                                    <span class="old-price">${{ $product->old_price }}</span>
                                @else
                                    <span class="price">${{ $product->price }}</span>
                                @endif
                                <span class="title">{{ $product->title }}</span>
                                <button class="my-btn btn-black">
                                    <i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i> Добавить в корзину
                                </button>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        @endisset
    </div>
</div>