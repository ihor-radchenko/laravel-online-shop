
<button class="my-btn btn-black {{ $size or '' }} addItemToCart"
        {{ ! $product->quantity ? 'disabled' : '' }}
        data-route="{{ route('cart.add') }}"
        data-product="{{ $product->id }}"
        data-quantity="{{ $product->quantity }}"
>
    @if($product->quantity)
        <i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i>
    @endif
    {{ $product->quantity ? Lang::get('button.add_to_cart') : Lang::get('button.not_in_stock') }}
</button>