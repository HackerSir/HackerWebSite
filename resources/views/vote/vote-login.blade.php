@extends('app')

@section('title')
    切換至投票帳號
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">切換至投票專用帳號（進入後僅能登出，無法直接轉回）</div>
                    {{-- Panel body --}}
                    <div class="panel-body text-center">
                        {{-- 登入 --}}
                        {!! Form::open(['route' => 'vote.user-vote'], ['class' => 'form-inline']) !!}
                        {!! Form::hidden('action', 'login') !!}
                        {!! Form::hidden('vid', $vid) !!}
                        {!! Form::submit('確認', ['class' => 'btn btn-danger btn-lg']) !!}
                        {!! HTML::link(URL::previous(), '返回', ['class' => 'btn btn-default btn-lg']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
