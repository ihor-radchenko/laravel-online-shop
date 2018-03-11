
@extends('home')

@section('home-content')
    <div class="panel-body">
        <form action="{{ route('user.update') }}" method="post">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="control-label">@lang('form.name')</label>
                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="form-control" required maxlength="255">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                <label for="surname" class="control-label">@lang('form.surname')</label>
                <input type="text" name="surname" id="surname" value="{{ Auth::user()->surname ?? '' }}" class="form-control" maxlength="255">
                @if ($errors->has('surname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('surname') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('patronymic') ? ' has-error' : '' }}">
                <label for="patronymic" class="control-label">@lang('form.patronymic')</label>
                <input type="text" name="patronymic" id="patronymic" value="{{ Auth::user()->patronymic ?? '' }}" class="form-control" maxlength="255">
                @if ($errors->has('patronymic'))
                    <span class="help-block">
                        <strong>{{ $errors->first('patronymic') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                <label for="phone_number" class="control-label">@lang('form.phone_number')</label>
                <div class="phone-number">
                    <input type="text" name="phone_number" id="phone_number" value="{{ Auth::user()->phone_number ?? '' }}" class="form-control" pattern="^\d{9}$" required>
                    <div class="code">+380</div>
                </div>
                @if ($errors->has('phone_number'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone_number') }}</strong>
                    </span>
                @endif
            </div>
            {{ csrf_field() }}
            <div class="center-container">
                <button type="submit" class="my-btn btn-black">@lang('button.confirm')</button>
            </div>
        </form>
    </div>
@endsection