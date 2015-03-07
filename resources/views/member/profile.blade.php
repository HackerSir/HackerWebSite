@extends('app')

@section('title')
    {{ $user->name }} - 個人資料
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $user->name }} - 個人資料</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="text-center">
                            {{-- Gravatar大頭貼 --}}
                            {!! HTML::image($user->gravatar(), null, ['class' => 'img-circle']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
