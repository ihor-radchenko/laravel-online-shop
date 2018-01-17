
<div id="carousel-example-generic" class="carousel slide hidden-xs" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="{{ asset('/img/carousel/slide_1_lt_5.jpg') }}" alt="">
            <div class="carousel-caption">
                <h3  style="color: white">Надежные автозапчасти</h3>
                <a>Купить сейчас</a>
            </div>
        </div>
        <div class="item">
            <img src="{{ asset('/img/carousel/slide_2_lt_5.jpg') }}" alt="">
            <div class="carousel-caption">
                <h3>Надежные автозапчасти</h3>
                <a>Купить сейчас</a>
            </div>
        </div>
        <div class="item">
            <img src="{{ asset('/img/carousel/slide_3_lt_5.jpg') }}" alt="">
            <div class="carousel-caption">
                <h3  style="color: white">Надежные автозапчасти</h3>
                <a>Купить сейчас</a>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>