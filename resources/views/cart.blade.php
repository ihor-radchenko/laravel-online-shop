
@extends('layouts.master')

@section('content')
    <div class="container margin-top25">
        <div class="row">
            @if($cart->count())
                <div class="col-sm-8">
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
                                        <th>
                                            <img src="{{ asset($item->product->img) }}" alt="{{ $item->product->title }}">
                                        </th>
                                        <th>
                                            <a href="{{ route('product', ['product' => $item->product->id]) }}" class="color-black">
                                                {{ $item->product->title }}
                                            </a>
                                        </th>
                                        <th>{{ $item->quantity }}</th>
                                        <th>${{ $item->product->price * $item->quantity }}</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="well">
                        <h4 class="color-black">@lang('cart.cart')</h4>
                        <hr>
                        @include('partials.sidebar.cart')
                        <a href="" class="my-btn btn-black">@lang('button.checkout')</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection