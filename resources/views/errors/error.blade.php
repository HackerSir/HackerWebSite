@extends('app')

@section('title')
    {{ $code }}
@endsection

@section('content')
    <div class="container">
        <div class="row text-center">
            {!! HTML::image('pic/'. $code . '.jpg','Bad Request'); !!}
        </div>
    </div>
@endsection
