
@isset($warehouse)
    <div class="row">
        <div class="col-sm-4 text-right">@lang('delivery_auto.city_name')</div>
        <div class="col-sm-8">{{ $warehouse->get('CityName') }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4 text-right">@lang('delivery_auto.address')</div>
        <div class="col-sm-8">{{ $warehouse->get('address') }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4 text-right">@lang('delivery_auto.operating_time')</div>
        <div class="col-sm-8">{{ $warehouse->get('operatingTime') }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4 text-right">@lang('delivery_auto.phone')</div>
        <div class="col-sm-8">{{ $warehouse->get('Phone') }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4 text-right">@lang('delivery_auto.email_storage')</div>
        <div class="col-sm-8">{{ $warehouse->get('EmailStorage') }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4 text-right">@lang('delivery_auto.rc_phone_security')</div>
        <div class="col-sm-8">{{ $warehouse->get('RcPhoneSecurity') }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4 text-right">@lang('delivery_auto.rc_phone_managers')</div>
        <div class="col-sm-8">{{ $warehouse->get('RcPhoneManagers') }}</div>
    </div>
@endisset