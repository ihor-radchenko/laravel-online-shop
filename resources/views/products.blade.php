
@extends('layouts.master')

@section('content')
    <ul class="breadcrumb hidden-xs">
        <li><a href="#">Home</a></li>
        <li><a href="#">Products</a></li>
        <li class="active">Accessories</li>
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-sm-3 hidden-xs">
                @include('templates.sidebar.products')
            </div>
            <div class="col-sm-9 products-block">
                <div class="row">
                    <div class="col-sm-12 hidden-xs">
                        <div class="products-options">
                            <div class="products-layouts">
                                <button class="product-grid"><i class="fa fa-th fa-lg" aria-hidden="true"></i></button>
                                <button class="product-list"><i class="fa fa-th-list fa-lg" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 visible-xs">
                        <button class="my-btn btn-black btn-lg filter-btn" data-toggle="modal" data-target="#myModal">
                            Фильтр
                        </button>
                    </div>
                </div>
                @include('templates.products.list')
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="visible-xs">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        @include('templates.sidebar.products')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="my-btn btn-white" data-dismiss="modal">Закрыть</button>
                        <button type="button" class="my-btn btn-black">Фильтр</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection