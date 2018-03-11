
@extends('layouts.master')

@section('content')
    <div class="container margin-top25">
        <div class="row">
            @if($cart->isNotEmpty())
                <div class="col-sm-10 col-sm-offset-1">
                    @include('partials.flash')
                    <div class="well">
                        <table class="table cart-list">
                            <thead>
                                <tr class="color-black">
                                    <th>@lang('cart.img')</th>
                                    <th>@lang('cart.product')</th>
                                    <th>@lang('cart.quantity')</th>
                                    <th>@lang('cart.price')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart->all() as $item)
                                    <tr>
                                        <th class="image">
                                            <img src="{{ asset($item->product->img) }}" alt="{{ $item->product->title }}">
                                        </th>
                                        <th class="desc">
                                            <div class="title">
                                                <a href="{{ route('product', ['product' => $item->product->id]) }}" class="color-black">
                                                    {{ $item->product->title }}
                                                </a>
                                            </div>
                                            <div class="price">
                                                {{ $item->product->price }}
                                            </div>
                                            <div class="on-stock">
                                                @lang('page.on_warehouse') {{ $item->product->quantity }}
                                            </div>
                                        </th>
                                        <th class="quantity">
                                            <div>
                                                <button class="subtractItem changeQuantity"
                                                    data-route="{{ route('cart.add') }}"
                                                    data-product="{{ $item->product->id }}"
                                                >
                                                    -
                                                </button>
                                                <span class="num">{{ $item->quantity }}</span>
                                                <button class="addItem {{ $item->allInCart() ? '' : 'changeQuantity' }}"
                                                    data-route="{{ route('cart.add') }}"
                                                    data-product="{{ $item->product->id }}"
                                                    data-maxQuantity="{{ $item->product->quantity }}"
                                                    data-quantityOverstated="@lang('cart.quantity_overstated')"
                                                    {{ $item->allInCart() ? 'disabled' : '' }}
                                                >
                                                    +
                                                </button>
                                            </div>
                                        </th>
                                        <th class="amountPrice">{{ $currencySymbol }}<span>{{ $item->getAmount()->format() }}</span></th>
                                        <th>
                                            <button class="removeItem" data-route="{{ route('cart.remove') }}" data-product="{{ $item->product->id }}">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </th>
                                    </tr>
                                @endforeach
                                <tr class="color-black last-row-in-cart">
                                    <th colspan="3" class="text-right">@lang('cart.full_price')</th>
                                    <th class="full-price">{{ $currencySymbol }}<span id="totalPrice">{{ $cart->totalPrice()->format() }}</span></th>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <a href="{{ route('order') }}" class="my-btn btn-black">@lang('button.checkout')</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <h1 class="color-black text-center">@lang('cart.empty_cart')</h1>
            @endif
        </div>
    </div>
@endsection