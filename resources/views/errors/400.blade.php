@extends('app')

@section('title')
    400
@endsection

@section('content')
    <div class="container">
        <div class="row text-center">
            {!! HTML::image('pic/400.jpg','Bad Request'); !!}
        </div>
    </div>
@endsection
