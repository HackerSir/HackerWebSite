@extends('app')

@section('content')
<div id="fullpage">
    {{-- Welcome section--}}
    <div class="section" style="background-image: url('{{ URL::asset('pic/welcome.jpg') }}'); background-size: 100%;">

    </div>
    {{-- About section--}}
    <div class="section">
        <div class="col-md-6">
            {!! HTML::image('http://placehold.it/1024x768', null, ['width' => '100%']) !!}
        </div>
        <div class="col-md-6">
            <h1>關於我們</h1>
        </div>
    </div>
    {{-- Class section--}}
    <div class="section text-right">
        <div class="col-md-6">
            <h1>社團課程</h1>
        </div>
        <div class="col-md-6">
            {!! HTML::image('http://placehold.it/1024x768', null, ['width' => '100%']) !!}
        </div>
    </div>
    {{-- Activity section--}}
    <div class="section">
        <div class="col-md-6">
            {!! HTML::image('http://placehold.it/1024x768', null, ['width' => '100%']) !!}
        </div>
        <div class="col-md-6">
            <h1>社團活動</h1>
        </div>
    </div>
</div>
@endsection

@section('css')
    body {
        padding-top: 0px;
    }
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
