@extends('app')

@section('content')
<div id="fullpage">
    {{-- Welcome section--}}
    <div class="section" id="section1">

    </div>
    {{-- About section--}}
    <div class="section" id="section2">
        <div class="col-md-6 col-md-offset-6 section-text">
            <h1>關於我們</h1>

        </div>
    </div>
    {{-- Class section--}}
    <div class="section text-right" id="section3">
        <div class="col-md-6 section-text">
            <h1>社團課程</h1>

        </div>
    </div>
    {{-- Activity section--}}
    <div class="section" id="section4">
        <div class="col-md-6 col-md-offset-6 section-text">
            <h1>社團活動</h1>

        </div>
    </div>
</div>
@endsection

@section('css')
    body {
        padding-top: 0px;
    }

    .section {
        background-size: 100%;
        background-repeat: no-repeat;
        background-position: center center;
    }

    .section-text {
        background: rgba(255,255,255,0.5);
        height: 100%;
        color: black;
    }

    #section1 {
        background-image: url({{ URL::asset('pic/welcome.jpg') }});
    }
    #section2 {
        background-image: url(http://placehold.it/1024x768);
    }
    #section3 {
        background-image: url(http://placehold.it/1024x768);
    }
    #section4 {
        background-image: url(http://placehold.it/1024x768);
    }
@endsection

@section('script')
    {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.5.9/jquery.fullPage.min.js'); !!}
    {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.5.9/vendors/jquery.easings.min.js'); !!}
    {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.5.9/vendors/jquery.slimscroll.min.js'); !!}
@endsection

@section('javascript')
    $(document).ready(function() {
        $('#fullpage').fullpage({
            paddingTop: '50px',
            scrollOverflow: true,
            scrollBar: true,
            //sectionsColor: ['black', '#4BBFC3', '#7BAABE', '#ccddff'],
            anchors: ['welcome', 'about', 'class', 'activity'],
        });
    });
@endsection
