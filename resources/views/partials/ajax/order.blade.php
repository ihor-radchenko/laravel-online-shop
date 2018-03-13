
@isset($order)
    <table class="table cart-list">
        <thead>
        <tr>
            <th>@lang('cart.img')</th>
            <th>@lang('cart.product')</th>
            <th>@lang('cart.quantity')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->cart as $item)
            <tr>
                <td class="image">
                    <img src="{{ asset($item->product->img) }}" alt="{{ $item->product->title }}">
                </td>
                <td>
                    <a href="{{ route('product', ['product' => $item->product->id]) }}" class="color-black">
                        {{ $item->product->title }}
                    </a>
                </td>
                <td>{{ $item->quantity }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endisset