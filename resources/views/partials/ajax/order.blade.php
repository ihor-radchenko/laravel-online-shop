
@isset($order)
    <table class="table">
        <thead>
        <tr>
            <th>@lang('cart.product')</th>
            <th>@lang('cart.quantity')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->cart as $item)
            <tr>
                <td><a href="{{ route('product', ['product' => $item->product->id]) }}">{{ $item->product->title }}</a></td>
                <td>{{ $item->quantity }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endisset