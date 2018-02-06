<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <title>Document</title>
</head>
<body>

<header class="header">
    <div class="container">
        <div class="header-wrap">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('/img/autokit.png') }}" alt="logo">
            </a>
            <a class="nav-cart">
                <span class="glyphicon glyphicon-shopping-cart"></span>@lang('page.my_cart')<span class="cart-count">0</span>
            </a>
        </div>
    </div>
</header>

@include('partials.nav')

<div class="main-content">
    @yield('content')
</div>

<footer>
    <a href="{{ route('home') }}" class="logo">
        <img src="{{ asset('/img/autokit.png') }}" alt="logo">
    </a>
    <h3 class="copyright color-black">
        Copyright {{ date('Y') }}
    </h3>
</footer>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>