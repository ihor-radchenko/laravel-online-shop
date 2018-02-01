
<div class="container-fluid">
    @isset($categories)
        @foreach($categories->chunk(4) as $chunk)
            <div class="row">
                @foreach($chunk as $category)
                    <div class="col-sm-6 col-md-3 p0">
                        <div class="cat-img inner-border">
                            <img src="{{ asset($category->img) }}" alt="">
                            <div class="inner">
                                <div class="category-name text-uppercase">{{ $category->title }}</div>
                                <a href="{{ route('products.category', ['menu' => $category->menu->alias, 'category' => $category->alias]) }}" class="button-more">
                                    <span class="text-uppercase">@lang('button.show_more')</span>
                                    <i class="fa fa-arrow-circle-o-right fa-2x" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    @endisset
</div>