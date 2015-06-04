@extends('app')

@section('title')
    社員大會通知
@endsection

@section('css')
    body{
        background-color: #2D2535;
    }
@endsection

@section('content')
    <div class="container">
        <div class="centered">
            {!! HTML::image('pic/entrance.png', '', array('class'=>'img-responsive')) !!}
        </div>
    </div>
@endsection