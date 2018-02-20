
<button class="my-btn btn-black {{ $size or '' }} {{ $cart->hasFree($product) ? 'addItemToCart' : '' }}"
    {{ $cart->hasFree($product) ? '' : 'disabled' }}
    data-route="{{ route('cart.add') }}"
    data-product="{{ $product->id }}"
    data-quantity="{{ $product->quantity }}"
    data-msgnotinstock="@lang('button.not_in_stock')"
>
    @if($cart->hasFree($product))
        <i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i>
    @endif
    {{ $cart->hasFree($product) ? Lang::get('button.add_to_cart') : Lang::get('button.not_in_stock') }}
</button>