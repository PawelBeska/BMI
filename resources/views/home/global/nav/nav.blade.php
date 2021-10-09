<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" redirect="true" href="/">BMI</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home.index')}}/"
                       redirect="true">{{__('messages.menu.home')}} </a>
                </li>
            @endauth
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{route('auth.login')}}"
                       redirect="true">{{__('messages.menu.login')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('auth.register')}}"
                       redirect="true">{{__('messages.menu.register')}}</a>
                </li>
            @endguest
        </ul>
        <ul class="navbar-nav float-right">
            @auth()
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.logout') }}">@lang('messages.menu.logout')</a>
                </li>
                @endauth

        </ul>
    </div>
</nav>
