@foreach ($navbar as $name => $uri)
    @if(is_array($uri))
        {{-- 次級選單 --}}
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ (Auth::check())?str_replace('%user%',Auth::user()->nickname,$name):$name }}<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                @foreach ($uri as $subName => $subUri)
                    {{-- 一般項目 --}}
                    <li @if((Request::is($subUri) && $subUri!="/") || Request::route()->getPath()==$subUri) class="active" @endif>
                        <a href="{{ URL::to($subUri) }}">{{ (Auth::check())?str_replace('%user%',Auth::user()->nickname,$subName):$subName }}</a>
                    </li>
                @endforeach
            </ul>
        </li>
    @else
        {{-- 一般項目 --}}
        <li @if((Request::is($uri) && $uri!="/") || Request::route()->getPath()==$uri) class="active" @endif>
            <a href="{{ URL::to($uri) }}">{{ (Auth::check())?str_replace('%user%',Auth::user()->nickname,$name):$name }}</a>
        </li>
    @endif
@endforeach
