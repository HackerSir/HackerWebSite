<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@if (trim($__env->yieldContent('title'))) @yield('title') - @endif{{ Config::get('config.sitename') }}</title>

        {!! HTML::style('css/app.css'); !!}
        {!! HTML::style('//maxcdn.bootstrapcdn.com/bootswatch/3.3.2/slate/bootstrap.css'); !!}
        {!! HTML::style('//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.5.9/jquery.fullPage.min.css'); !!}
        {!! HTML::style('css/animate.css'); !!}
        {!! HTML::style('css/stylesheet.css'); !!}
        {!! HTML::style('css/bootstrap-datetimepicker.css'); !!}
        <style type="text/css">
            @yield('css')
        </style>

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
            {{-- content --}}
            @yield('content')
        </div>

        <!-- Scripts -->
        {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'); !!}
        {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js'); !!}
        {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.5.9/jquery.fullPage.min.js'); !!}
        {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.5.9/vendors/jquery.easings.min.js'); !!}
        {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.5.9/vendors/jquery.slimscroll.min.js'); !!}
        {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js'); !!}
        {!! HTML::script('js/moment_zh-tw.js'); !!}
        {!! HTML::script('js/bootstrap-datetimepicker.js'); !!}
        {!! HTML::script('js/bootstrap-notify.min.js'); !!}
        <script type="text/javascript">
            @if(Session::has('global'))
                /* Global message */
                /* Bootstrap Notify */
                $.notify({
                    // options
                    message: '{{ Session::get('global') }}'
                },{
                    // settings
                    type: 'success',
                    placement: {
                        align: 'center'
                    },
                    offset: 70,
                    delay: 5000,
                    timer: 500,
                    mouse_over: 'pause',
                    animate: {
                        enter: 'animated zoomIn',
                        exit: 'animated zoomOut'
                    }
                });
            @endif
            @if(Session::has('warning'))
                /* Warning message */
                /* Bootstrap Notify */
                $.notify({
                    // options
                    message: '{{ Session::get('warning') }}'
                },{
                    // settings
                    type: 'danger',
                    placement: {
                        align: 'center'
                    },
                    offset: 70,
                    delay: 0,
                    timer: 500,
                    mouse_over: 'pause',
                    animate: {
                        enter: 'animated rubberBand',
                        exit: 'animated zoomOut'
                    }
                });
            @endif
            @yield('javascript')
        </script>
    </body>
</html>
