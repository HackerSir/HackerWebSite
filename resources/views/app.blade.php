<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@if (trim($__env->yieldContent('title'))) @yield('title') - @endif{{ Config::get('config.sitename') }}</title>

        {!! HTML::style('css/app.css'); !!}
        {!! HTML::style('css/stylesheet.css'); !!}

        <!-- Fonts -->
        {!! HTML::style('//fonts.googleapis.com/css?family=Roboto:400,300'); !!}

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            {!! HTML::script('https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'); !!}
            {!! HTML::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js'); !!}
        <![endif]-->
    </head>
    <body>
        {{-- navbar--}}
        @include('common.navbar')
        <div class="container-fluid">
            {{-- global message --}}
            @if(Session::has('global'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    {{ Session::get('global') }}
                </div>
            @endif
            {{-- content --}}
            @yield('content')
        </div>

        <!-- Scripts -->
        {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'); !!}
        {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js'); !!}
    </body>
</html>
