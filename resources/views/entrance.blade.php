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
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-sm-4">
                {!! HTML::image('pic/entrance.png', '', array('class'=>'img-responsive')) !!}
            </div>
        </div>
    </div>

@endsection