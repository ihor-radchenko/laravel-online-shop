
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
                                @if($product->quantity >= 10)
                                    <div class="stock text-success">В наличии <i class="fa fa-check" aria-hidden="true"></i></div>
                                @elseif($product->quantity > 0 && $product->quantity < 10)
                                    <div class="stock text-warning">Заканчиваеться <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></div>
                                @else
                                    <div class="stock text-danger">Нет в наличии <i class="fa fa-times" aria-hidden="true"></i></div>
                                @endif
                                <div class="count color-black">На складе: {{ $product->quantity }}</div>
                                <h2 class="title">{{ $product->title }}</h2>
                                @if(! is_null($product->old_price))
                                    <span class="new-price">${{ $product->price }}</span>
                                    <span class="old-price">${{ $product->old_price }}</span>
                                @else
                                    <span class="price">${{ $product->price }}</span>
                                @endif
                                <p class="short-content">
                                    Для нас большая честь представить вам наши продукты. Мы предоставляем автозапчасти, и наша главная цель - удовлетворить всех наших клиентов
                                </p>
                                <div class="qty">
                                    <label for="qty" class="color-black">Количество</label>
                                    <input type="number" id="qty" value="1" class="text-center color-black" max="{{ $product->quantity }}" min="1" {{ ! $product->quantity ? 'disabled' : '' }}>
                                </div>
                                <button class="my-btn btn-black btn-lg" {{ ! $product->quantity ? 'disabled' : '' }}>
                                    <i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i> Добавить в корзину
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 hidden-xs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#details" data-toggle="tab">Детали</a></li>
                                <li><a href="#more-informations" data-toggle="tab">Больше информации</a></li>
                                <li><a href="#reviews" data-toggle="tab">Отзывы</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active text-justify" id="details">
                                    {{ $product->description }}
                                </div>
                                <div class="tab-pane" id="more-informations">
                                    @include('templates.product.more_informations')
                                </div>
                                <div class="tab-pane" id="reviews">
                                    @include('templates.product.reviews')
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 visible-xs">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                Детали
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
                                                Больше информации
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            @include('templates.product.more_informations')
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                Отзывы
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            @include('templates.product.reviews')
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
@endsection