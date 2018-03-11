@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row margin-top25">
        <div class="col-md-2">@include('partials.sidebar.home')</div>
        <div class="col-md-8">
            @include('partials.flash')
            <div class="panel panel-default">
                <div class="panel-heading"><h4>@lang('page.personal_area')</h4></div>
                @yield('home-content')
            </div>
        </div>
    </div>
</div>
@endsection
