<h3 class="color-black">@lang('form.delivery')</h3>
<hr>
<div class="form-group">
    <div class="col-sm-3 text-right">
        <input type="radio" name="delivery" value="off" id="offDelivery" class="changeDelivery" data-route="{{ route('order.selfDelivery') }}">
    </div>
    <div class="col-sm-9">
        <label for="offDelivery">@lang('form.no_delivery')</label>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-3 text-right">
        <input type="radio" name="delivery" value="on" id="onDelivery" class="changeDelivery" data-route="{{ route('delivery.delivery') }}">
    </div>
    <div class="col-sm-9">
        <label for="onDelivery">@lang('delivery_auto.delivery')</label>
    </div>
</div>