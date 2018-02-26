<h3 class="color-black">@lang('form.address')</h3>
<hr>

<div class="form-group">
    <div class="row">
        <div class="col-sm-3 text-right">
            <label for="region">@lang('form.region')</label>
        </div>
        <div class="col-sm-9">
            <select name="region" id="region" class="form-control" data-route="{{ route('order.region')}}">
                <option value="none"></option>
                @isset($regions)
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                    @endforeach
                @endisset
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
            <select name="city" id="city" disabled class="form-control" data-route="{{ route('order.city') }}"></select>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-sm-3 text-right">
            <label for="warehouses">@lang('form.warehouses')</label>
        </div>
        <div class="col-sm-9">
            <select name="warehouses" id="warehouses" disabled class="form-control"></select>
        </div>
    </div>
</div>