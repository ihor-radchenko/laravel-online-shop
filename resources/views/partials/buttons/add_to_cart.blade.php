
<button class="my-btn btn-black {{ $size or '' }} {{ $product->hasFreeStock($cart) ? 'addItemToCart' : '' }}"
    {{ $product->hasFreeStock($cart) ? '' : 'disabled' }}
    data-route="{{ route('cart.add') }}"
    data-product="{{ $product->id }}"
    data-quantity="{{ $product->quantity }}"
    data-msgnotinstock="@lang('button.not_in_stock')"
>
    @if($product->hasFreeStock($cart))
        <i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i>
    @endif
    {{ $product->hasFreeStock($cart) ? Lang::get('button.add_to_cart') : Lang::get('button.not_in_stock') }}
</button>