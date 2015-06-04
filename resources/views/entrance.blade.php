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
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 text-center">
            {!! HTML::image('pic/entrance.png', '', array('class'=>'img-responsive')) !!}
        </div>
    </div>
@endsection