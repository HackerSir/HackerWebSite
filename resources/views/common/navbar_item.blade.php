@foreach ($navbar as $name => $uri)
    @if(is_array($uri))
        {{-- 次級選單 --}}
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ (Auth::check())?str_replace('%user%',Auth::user()->name,$name):$name }}<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                @foreach ($uri as $subName => $subUri)
                    {{-- 一般項目 --}}
                    <li @if((strstr(Request::route()->getPath(),$subUri) && $subUri!="/") || Request::route()->getPath()==$subUri) class="active" @endif>
                        <a href="{{ URL::to($subUri) }}">{{ (Auth::check())?str_replace('%user%',Auth::user()->name,$subName):$subName }}</a>
                    </li>
                @endforeach
            </ul>
        </li>
    @else
        {{-- 一般項目 --}}
        <li @if((strstr(Request::route()->getPath(),$uri) && $uri!="/") || Request::route()->getPath()==$uri) class="active" @endif>
            <a href="{{ URL::to($uri) }}">{{ (Auth::check())?str_replace('%user%',Auth::user()->name,$name):$name }}</a>
        </li>
    @endif
@endforeach