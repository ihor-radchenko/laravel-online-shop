
<h3 class="color-black">@lang('form.person_data')</h3>
<hr>
<div class="form-group margin-top25{{ $errors->has('customer_name') ? ' has-error' : '' }}">
    <div class="row">
        <div class="col-sm-3 text-right">
            <label for="full_name" class="control-label">@lang('form.full_name')</label>
        </div>
        <div class="col-sm-9">
            <input type="text" name="customer_name" id="full_name" class="form-control" required maxlength="255" value="{{ Auth::user()->full_name ?? old('customer_name') }}">
            @if ($errors->has('customer_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('customer_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group{{ $errors->has('customer_email') ? ' has-error' : '' }}">
    <div class="row">
        <div class="col-sm-3 text-right">
            <label for="email" class="control-label">@lang('form.email')</label>
        </div>
        <div class="col-sm-9">
            <input type="email" name="customer_email" id="email" class="form-control" required maxlength="255" value="{{ Auth::user()->email ?? old('customer_email') }}">
            @if ($errors->has('customer_email'))
                <span class="help-block">
                    <strong>{{ $errors->first('customer_email') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group{{ $errors->has('customer_phone_number') ? ' has-error' : '' }}">
    <div class="row">
        <div class="col-sm-3 text-right">
            <label for="phone_number" class="control-label">@lang('form.phone_number')</label>
        </div>
        <div class="col-sm-9">
            <div class="phone-number">
                <input type="text" name="customer_phone_number" id="phone_number" class="form-control" required pattern="^\d{9}$" value="{{ Auth::user()->phone_number ?? old('customer_phone_number') }}">
                <div class="code">+380</div>
            </div>
            @if ($errors->has('customer_phone_number'))
                <span class="help-block">
                    <strong>{{ $errors->first('customer_phone_number') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>