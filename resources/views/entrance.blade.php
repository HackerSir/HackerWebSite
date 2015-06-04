@extends('app')

@section('title')
    社員大會通知
@endsection

@section('css')
    body{
        background-color: #2D2535;
    }
    .img-alpha{
        filter: Alpha(Opacity=100, FinishOpacity=0, Style=3);
    }
@endsection

@section('content')
    <div class="center-block">
        {!! HTML::image('pic/entrance.png', '', array('class'=>'img-responsive img-alpha')) !!}
    </div>

@endsection