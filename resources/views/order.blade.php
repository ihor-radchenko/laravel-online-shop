@extends('layouts.master')

@section('content')
<div class="container margin-top25">
    <div class="row">
        <div class="col-sm-8">
            @include('partials.order.form')
        </div>
        <div class="col-sm-4">
            <div class="well" id="cartSidebar">@include('partials.sidebar.order')</div>
        </div>
    </div>
</div>
    @include('partials.ajax.message')
@endsection