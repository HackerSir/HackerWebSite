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
    <div class="text-center">
        {!! HTML::image('pic/entrance.png', '', array('class'=>'img-responsive center-block')) !!}
        <a class="btn btn-primary btn-lg" href="{!! URL::route('home') !!}" role="button">進入社網</a>
    </div>
@endsection