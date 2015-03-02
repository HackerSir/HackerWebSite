@extends('app')

@section('title')
    404
@endsection

@section('content')
    <div class="container">
        <div class="row text-center">
            {!! HTML::image('pic/404.jpg','Not found'); !!}
        </div>
    </div>
@endsection
