@extends('layouts.master')

@section('content')
    @include('templates.main.carousel')
    @include('templates.main.category_image')
    @include('templates.main.top_products')
    @include('templates.main.new_products')
    @include('templates.main.from_blog')
    @include('templates.subscribe')
@endsection