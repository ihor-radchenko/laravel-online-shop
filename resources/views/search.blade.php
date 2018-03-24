
@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <h3 class="color-black">@lang('page.searchQuery') <span class="search-q">"{{ $searchQuery }}"</span></h3>
                <h5 class="color-black">@lang('page.searchResult') {{ $products->count() }}</h5>
                <hr>
                @if($products->isEmpty())
                    <h4 class="color-black">@lang('page.searchEmpty')</h4>
                @else
                    <table class="table search-list">
                        @foreach($products as $product)
                            <tr class="search-item">
                                <td><img src="{{ asset($product->img) }}" alt=""></td>
                                <td>
                                    <a href="{{ route('product', ['product' => $product->id]) }}" class="color-black">
                                        {{ $product->title }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection