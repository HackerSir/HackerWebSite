@extends('app')

@section('title')
    {{ $announcement->title }}
@endsection

@section('css')
    body{
        background-color: #2D2535;
    }
@endsection

@section('content')
    <div class="text-center">
        {!! $announcement->message !!}
        <div>
            {!! HTML::linkRoute('home', '進入社網', [], ['class' => 'btn btn-primary btn-lg', 'role' => 'button']) !!}
        </div>
    </div>
@endsection
