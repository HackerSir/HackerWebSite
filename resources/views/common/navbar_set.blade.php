@foreach ($navbar as $name => $uri)
    @if(is_array($uri))
        {{-- 次級選單 --}}
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ (Auth::check())?str_replace('%user%',Auth::user()->nickname,$name):$name }}<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                @foreach ($uri as $subName => $subUri)
                    {{-- 一般項目 --}}
                    @include('common.navbar_item', ['uri' => $subUri, 'name' => $subName])
                @endforeach
            </ul>
        </li>
    @else
        {{-- 一般項目 --}}
        @include('common.navbar_item', ['uri' => $uri, 'name' => $name])
    @endif
@endforeach
