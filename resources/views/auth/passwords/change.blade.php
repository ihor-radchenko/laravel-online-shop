
@extends('home')

@section('home-content')
    <div class="panel-body">
        <form action="{{ route('user.update.pass') }}" method="post">
            <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                <label for="current_password" class="control-label">@lang('form.pass')</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required maxlength="255">
                @if ($errors->has('current_password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('current_password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label">@lang('form.new_pass')</label>
                <input type="password" name="password" id="password" class="form-control" maxlength="255" required minlength="6">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="control-label">@lang('form.conf_pass')</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" maxlength="255" required>
            </div>
            {{ csrf_field() }}
            <div class="center-container">
                <button type="submit" class="my-btn btn-black">@lang('button.confirm')</button>
            </div>
        </form>
    </div>
@endsection