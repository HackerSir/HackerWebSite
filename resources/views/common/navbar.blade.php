<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">{{ Config::get('config.sitename') }}</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                {{-- 左側主要選單 --}}
                @foreach (Config::get('navbar.navbar') as $name => $uri)
                    @if(is_array($uri))
                        {{-- 次級選單 --}}
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ $name }}<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                @foreach ($uri as $subName => $subUri)
                                    {{-- 一般項目 --}}
                                    <li @if((strstr(Request::route()->getPath(),$subUri) && $subUri!="/") || Request::route()->getPath()==$subUri) class="active" @endif>
                                    <a href="{{ URL::to($subUri) }}">{{ $subName }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        {{-- 一般項目 --}}
                        <li @if((strstr(Request::route()->getPath(),$uri) && $uri!="/") || Request::route()->getPath()==$uri) class="active" @endif>
                            <a href="{{ URL::to($uri) }}">{{ $name }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>

            <ul class="nav navbar-nav navbar-right">
                {{-- 右側選單 --}}
                {{-- TODO:以下未修改 --}}
                @if (Auth::guest())
                    <li><a href="{{ URL::route('member.login') }}">Login</a></li>
                    <li><a href="{{ URL::route('member.register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ URL::route('member.logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
