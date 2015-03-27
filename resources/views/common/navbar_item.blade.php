<li @if((Request::is($uri) && $uri!="/") || Request::route()->getPath()==$uri) class="active" @endif>
    <a href="{{ URL::to($uri) }}" @if(strpos($uri,'://')) target="_blank" @endif>
        {{ (Auth::check())?str_replace('%user%',Auth::user()->nickname,$name):$name }}
        @if(strpos($uri,'://'))
            <i class="glyphicon glyphicon-new-window"></i>
        @endif
    </a>
</li>
