<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@lang('email.order_title')</title>
</head>
<body>
<h1>@lang('email.order_head', ['num' => $order->id])</h1>

<div>
    <table>
        <thead>
        <tr>
            <th>@lang('cart.img')</th>
            <th>@lang('cart.product')</th>
            <th>@lang('cart.quantity')</th>
            <th>@lang('cart.price')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->cart as $item)
            <tr>
                <th>
                    <img src="{{ asset($item->product->img) }}" alt="{{ $item->product->title }}">
                </th>
                <th>
                    <div>
                        <a href="{{ route('product', ['product' => $item->product->id]) }}">
                            {{ $item->product->title }}
                        </a>
                    </div>
                    <div>
                        {{ $item->product->price }}
                    </div>
                </th>
                <th>
                    <div>
                        <span>{{ $item->quantity }}</span>
                    </div>
                </th>
                <th>{{ $currencySymbol }}<span>{{ $item->getAmount()->format() }}</span></th>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<p>
    @lang('email.order_tnx', ['name' => $order->customer_name])
</p>
</body>
</html>