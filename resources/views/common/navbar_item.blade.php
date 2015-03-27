<li @if((Request::is($uri) && $uri!="/") || Request::route()->getPath()==$uri) class="active" @endif>
    <a href="{{ URL::to($uri) }}">{{ (Auth::check())?str_replace('%user%',Auth::user()->nickname,$name):$name }}</a>
</li>
