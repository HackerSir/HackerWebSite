@extends('app')

@section('title')
    {{ $code }}
@endsection

@section('content')
    <div class="container">
        <div class="row text-center">
            <h1>{{ $code }}</h1>
            <h1>{{ $message }}</h1>
            @if(!empty($pic))
                {!! HTML::image($pic, $message, ['width' => '600px']); !!}
            @endif
        </div>
    </div>
@endsection
