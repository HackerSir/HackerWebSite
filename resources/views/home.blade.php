@extends('app')

@section('content')
<div id="fullpage">
    <div class="section">
        {!! HTML::image('pic/welcome.jpg', null, ['width' => '100%', 'height' => '100%']) !!}
    </div>
    <div class="section">
        <h1>關於我們</h1>
        {!! HTML::image('http://placehold.it/1024x768') !!}
    </div>
    <div class="section">
        <h1>社團課程</h1>
        {!! HTML::image('http://placehold.it/1024x768') !!}
    </div>
    <div class="section">
        <h1>社團活動</h1>
        {!! HTML::image('http://placehold.it/1024x768') !!}
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
            sectionsColor: ['black', '#4BBFC3', '#7BAABE', '#ccddff'],
            anchors: ['welcome', 'about', 'class', 'activity'],
        });
    });
@endsection
