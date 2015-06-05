<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::route('home') }}">{{ Config::get('config.sitename') }}</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @if(Request::is('vote'))
                    {{-- TODO : Add Navbar for Vote--}}
                @elseif (Auth::check() && Auth::user()->group->name == 'vote')
                    {{-- 投票專用 --}}
                    @include('common.navbar_set', ['navbar' => Config::get('navbar.vote')])
                @else
                    {{-- 右側主要選單 --}}
                    @include('common.navbar_set', ['navbar' => Config::get('navbar.navbar')])
                    {{-- 學生會--}}
                    {{-- @if (Auth::check() && (Auth::user()->isStaff() || Auth::user()->isSA()))
                        @include('common.navbar_set', ['navbar' => Config::get('navbar.sa')])
                    @endif --}}
                    {{-- 工作人員 --}}
                    @if (Auth::check() && Auth::user()->isStaff())
                        @include('common.navbar_set', ['navbar' => Config::get('navbar.staff')])
                    @endif
                    {{-- Auth --}}
                    @if (Auth::guest())
                        @include('common.navbar_set', ['navbar' => Config::get('navbar.guest')])
                    @else
                        @include('common.navbar_set', ['navbar' => Config::get('navbar.member')])
                    @endif
                @endif
            </ul>
        </div>
    </div>
</nav>
