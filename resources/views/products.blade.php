
@extends('layouts.master')

@section('content')
    {{ Breadcrumbs::render('products', $breadcrumb) }}
    <div class="container">
        <div class="row">
            <div class="col-sm-3 hidden-xs">
                @include('partials.sidebar.products')
            </div>
            <div class="col-sm-9 products-block">
                <div class="row">
                    <div class="col-sm-12 hidden-xs">
                        <div class="products-options">
                            <div class="sort">
                                <span>@lang('page.sort_price')</span>
                                <button class="btn-sort sort-desc" title="@lang('page.sort_desc')"
                                    data-desc="@lang('page.sort_desc')"
                                    data-asc="@lang('page.sort_asc')"
                                >
                                    <input type="hidden" id="sort_type" value="">
                                    <i class="fa fa-sort-amount-desc"></i>
                                </button>
                            </div>
                            <div class="products-layouts">
                                <button class="showType active" id="product-grid" data-show="grid"><i class="fa fa-th fa-lg" aria-hidden="true"></i></button>
                                <button class="showType" id="product-list" data-show="list"><i class="fa fa-th-list fa-lg" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 visible-xs">
                        <button class="my-btn btn-black btn-lg filter-btn" data-toggle="modal" data-target="#myModal">
                            @lang('button.filter')
                        </button>
                    </div>
                </div>
                <input type="hidden" id="maxPrice" value="{{ $maxPrice }}">
                <div class="products-list margin-top25">
                    @include('partials.products.grid')
                </div>
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
                        @include('partials.sidebar.products')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="my-btn btn-white" data-dismiss="modal" id="deleteFilter">@lang('button.deleteFilter')</button>
                        <button type="button" class="my-btn btn-black" id="Filter">@lang('button.filter')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection