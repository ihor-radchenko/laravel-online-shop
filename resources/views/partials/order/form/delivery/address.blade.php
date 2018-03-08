<h3 class="color-black">@lang('form.address')</h3>
<hr>

<div class="form-group">
    <div class="row">
        <div class="col-sm-3 text-right">
            <label for="region">@lang('form.region')</label>
        </div>
        <div class="col-sm-9">
            <select name="region_id" id="region" class="form-control" data-route="{{ route('delivery.region')}}">
                @include('partials.order.form.delivery.item_list', ['items' => $regions])
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-sm-3 text-right">
            <label for="city">@lang('form.city')</label>
        </div>
        <div class="col-sm-9">
            <select name="city_id" id="city" disabled class="form-control calc-item" data-route="{{ route('delivery.city') }}"></select>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-sm-3 text-right">
            <label for="warehouses">@lang('form.warehouses')</label>
        </div>
        <div class="col-sm-9">
            <select name="warehouse_id" id="warehouses" disabled class="form-control calc-item" data-route="{{  route('delivery.warehouse') }}"></select>
        </div>
    </div>
</div>

<div id="warehouseInfo"></div>