
<nav class="nav-wrap">
    <div class="container">
        <nav class="navbar navbar-default main-nav" role="navigation">
            <div class="container-fluid nav-container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <div class="search-block hidden col-sm-11">
                        <form action="{{ route('search.index') }}" method="get">
                            <input type="text" id="SearchInput" class="form-control" data-route="{{ route('search.list') }}" name="q">
                            <button class="btn-white" id="GoSearch" type="submit">
                                <i class="fa fa-search fa-lg"></i>
                            </button>
                        </form>
                    </div>
                    <ul class="nav navbar-nav" id="MainNavBar">
                        @isset($menu_navigation)
                            @foreach($menu_navigation as $nav)
                                @if($nav->categories->count() > 0)
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown">{{ $nav->title }} <span class="caret"></span></a><div class="bot-link"></div>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('products.index', ['menu' => $nav->alias]) }}">{{ $nav->title }}</a></li>
                                            <li class="divider"></li>
                                            @foreach($nav->categories as $category)
                                                <li><a href="{{ route('products.category', ['menu' => $nav->alias, 'category' => $category->alias]) }}">{{ $category->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li><a href="/{{ $nav->alias }}">{{ $nav->title }}</a><div class="bot-link"></div></li>
                                @endif
                            @endforeach
                        @endisset
                    </ul>
                    <ul class="nav navbar-nav navbar-right hidden-xs">
                        <li><button class="btn-search show-search"><i class="fa fa-search fa-lg"></i></button></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-o fa-lg" aria-hidden="true"></i></a>
                            <ul class="dropdown-menu">
                                @guest
                                    <li><a href="{{ route('register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> @lang('auth.signup')</a></li>
                                    <li><a href="{{ route('login') }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> @lang('auth.signin')</a></li>
                                @else
                                    @admin
                                        <li>
                                            <a href="{{ route('admin.main') }}">
                                                <i class="fa fa-key"></i> @lang('page.admin_dashboard')
                                            </a>
                                        </li>
                                    @endadmin
                                    <li>
                                        <a href="{{ route('home') }}">
                                            <i class="fa fa-home"></i> @lang('page.personal_area')
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" class="btnLogout">
                                            <i class="fa fa-user-times"></i> @lang('auth.logout')
                                        </a>
                                    </li>
                                    <form class="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                @endguest
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
                <div class="visible-xs user-auth">
                    <a href="#"><i class="fa fa-user-plus fa-2x" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i></a>
                </div>
            </div>
        </nav>
    </div>
</nav>