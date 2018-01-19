
@extends('layouts.master')

@section('content')
    <ul class="breadcrumb hidden-xs">
        <li><a href="#">Home</a></li>
        <li><a href="#">Products</a></li>
        <li class="active">Accessories</li>
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 product">
                <div class="row product-show">
                    <div class="col-sm-5">
                        <img src="{{ asset('img/products/air_intake_hose_for_toyota_camry_2.2l_4cyl_1997_3__1.png') }}" alt="" class="image-response">
                    </div>
                    <div class="col-sm-7">
                        <div class="caption">
                            <div class="stock">В наличии</div>
                            <div class="count color-black">На складе: 23</div>
                            <h2 class="title">Jdfhsdjf asdfsaf</h2>
                            <div class="price">600$</div>
                            <p class="short-content">
                                Для нас большая честь представить вам наши продукты. Мы предоставляем автозапчасти, и наша главная цель - удовлетворить всех наших клиентов
                            </p>
                            <div class="qty">
                                <label for="qty" class="color-black">Количество</label>
                                <input type="number" id="qty" value="1" class="text-center color-black">
                            </div>
                            <button class="my-btn btn-black btn-lg">
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
                            <div class="tab-pane active" id="details">
                                @include('templates.product.details')
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
                                    <div class="panel-body">
                                        @include('templates.product.details')
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
@endsection