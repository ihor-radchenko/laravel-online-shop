
<table class="table">
    <tr>
        <td>@lang('cart.total_price')</td>
        <td>{{ $currencySymbol }}<span id="cart-total-price">{{ $cart->totalPrice()->format() }}</span></td>
    </tr>
    <tr>
        <td>@lang('cart.shipping')</td>
        <td>{{ $currencySymbol }}<span id="priceDelivery">0</span></td>
    </tr>
    <tr class="alert-success">
        <td>@lang('cart.full_price')</td>
        <td>{{ $currencySymbol }}<span id="totalPriceWithShipping">{{ $cart->totalPrice()->format() }}</span></td>
    </tr>
    <tr>
        <td colspan="2" class="text-center margin-top25">
            <button class="my-btn btn-black hidden" id="paymentBtn" data-toggle="modal" data-target="#paymentForm" disabled>
                @lang('button.payment')
            </button>
        </td>
    </tr>
</table>