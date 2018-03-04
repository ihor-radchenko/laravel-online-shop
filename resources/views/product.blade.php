
@extends('layouts.master')

@section('content')
    @isset($product)
        {{ Breadcrumbs::render('product', $product) }}
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 product">
                    <div class="row product-show">
                        <div class="col-sm-5">
                            <img src="{{ asset($product->img) }}" alt="" class="image-response">
                        </div>
                        @if($product->is_top)
                            <span class="top">Top</span>
                        @elseif($product->is_new)
                            <span class="new">New</span>
                        @endif
                        <div class="col-sm-7">
                            <div class="caption">
                                @if($product->outOfStock())
                                    <div class="stock text-danger">@lang('page.no_stock') <i class="fa fa-times" aria-hidden="true"></i></div>
                                @elseif($product->hasLowStock())
                                    <div class="stock text-warning">@lang('page.ends') <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></div>
                                @else
                                    <div class="stock text-success">@lang('page.in_stock') <i class="fa fa-check" aria-hidden="true"></i></div>
                                @endif
                                <div class="count color-black">@lang('page.on_warehouse') {{ $product->quantity }}</div>
                                <h2 class="title">{{ $product->title }}</h2>
                                @include('partials.product.price')
                                <p class="short-content">@lang('page.product_welcome')</p>
                                <div class="qty">
                                    <label for="qty" class="color-black">@lang('page.quantity')</label>
                                    <input type="number" id="qty" value="1" class="text-center color-black"
                                        max="{{ $cart->has($product) ? $cart->freeQuantity($product) : $product->quantity }}"
                                        min="1"
                                        {{ $product->hasFreeStock($cart) ? '' : 'disabled' }}
                                    >
                                </div>
                                @include('partials.buttons.add_to_cart', ['size' => 'btn-lg'])
                                <div class="rating">
                                    <div class="stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="glyphicon glyphicon-star{{ ($i <= round($product->reviews->avg('rating'))) ? '' : '-empty'}}"></span>
                                        @endfor
                                    </div>
                                    <div class="avg-rating" id="avgRating">{{ round($product->reviews->avg('rating'), 1) }}</div>
                                    <div class="count" id="countRating">{{ $product->reviews->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 hidden-xs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#details" data-toggle="tab">@lang('page.details')</a></li>
                                <li><a href="#more-informations" data-toggle="tab">@lang('page.more_info')</a></li>
                                <li><a href="#reviews" data-toggle="tab">@lang('page.reviews')</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active text-justify" id="details">
                                    {{ $product->description }}
                                </div>
                                <div class="tab-pane" id="more-informations">
                                    @include('partials.product.more_informations')
                                </div>
                                <div class="tab-pane" id="reviews">
                                    @include('partials.product.reviews')
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 visible-xs">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                @lang('page.details')
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body text-justify">
                                            {{ $product->description }}
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                @lang('page.more_info')
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            @include('partials.product.more_informations')
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                @lang('page.reviews')
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            @include('partials.product.reviews')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @isset($maxOffset)
        <input type="hidden" value="{{ $maxOffset }}" id="maxOffset">
    @endisset
@endsection