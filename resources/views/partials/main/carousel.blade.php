
@isset($carousel)
    <div id="carousel-example-generic" class="carousel slide hidden-xs" data-ride="carousel">
        <!-- Indicators -->

        <ol class="carousel-indicators">
            @for($i = 0; $i < $carousel->count(); $i++)
                <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" {{ $i === 0 ? 'class=active' : '' }}></li>
            @endfor
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            @foreach($carousel as $item)
                <div class="item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ asset($item->img) }}" alt="">
                    <div class="carousel-caption">
                        <h3>{!! $item->title !!}</h3>
                        <p>{!! $item->description !!}</p>
                        <a href="{{ route('products.index', ['menu' => $item->menu->alias]) }}">@lang('button.buy_now')</a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
@endisset