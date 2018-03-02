
<table class="table">
    <tr>
        <td>@lang('cart.total_price')</td>
        <td>$<span id="cart-total-price">{{ $cart->totalPrice() }}</span></td>
    </tr>
    <tr>
        <td>@lang('cart.shipping')</td>
        <td>$<span id="priceDelivery">0</span></td>
    </tr>
    <tr class="alert-success">
        <td>@lang('cart.full_price')</td>
        <td>$<span id="totalPriceWithShipping">{{ $cart->totalPrice() }}</span></td>
    </tr>
</table>