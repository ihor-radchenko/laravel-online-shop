@extends('layouts.master')

@section('content')
    @include('partials.main.carousel')
    @include('partials.main.category_image')
    @include('partials.main.top_products')
    @include('partials.main.new_products')
    @include('partials.main.from_blog')
    @include('partials.subscribe')
@endsection