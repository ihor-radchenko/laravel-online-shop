
@extends('home')

@section('home-content')
    @isset($orders)
        @if($orders->isNotEmpty())
            <table class="table">
                <thead>
                    <tr class="color-black orders-table-head">
                        <th class="text-center">@lang('page.num_order')</th>
                        <th>@lang('page.order_price')</th>
                        <th>@lang('page.shipping_price')</th>
                        <th>@lang('page.address')</th>
                        <th>@lang('page.order_weight')</th>
                        <th>@lang('page.order_dimension')</th>
                        <th>@lang('page.order_view')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="text-center">{{ $order->id }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>{{ $order->shipping_price }}</td>
                            <td>{{! is_null($order->warehouse) ? $order->warehouse->get('address') : Lang::get('page.is_self_delivery') }}</td>
                            <td>{{ $order->total_weight }}</td>
                            <td>{{ $order->total_dimensions }}</td>
                            <td class="text-center">
                                <button class="btn-link view-order" data-id="{{ $order->id }}" data-route="{{ route('order.info') }}">
                                    <i class="fa fa-eye fa-lg"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3 class="color-black text-center">@lang('page.empty_order')</h3>
        @endif

        <div class="modal fade" id="order-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title color-black">@lang('page.order')</h4>
                    </div>
                    <div class="modal-body" id="order-modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('button.close')</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    @endisset
@endsection