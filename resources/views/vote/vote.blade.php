@extends('app')

@section('title')
   社團投票 - {{$voteEvent->subject}}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">登陸畫面 {{$voteEvent->subject}}</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        {{-- 登入 --}}
                        {!! Form::open(['route' => 'vote.user-vote']) !!}
                        <div class="form-group has-feedback{{ ($errors->has('nid'))?' has-error':'' }}">
                            <label class="control-label" for="nid">學號
                                @if($errors->has('nid'))
                                    <span class="label label-danger">{{ $errors->first('nid') }}</span>
                                @endif
                            </label>
                            {!! Form::text('nid', null, ['id' => 'nid', 'placeholder' => '請輸入學號', 'class' => 'form-control', 'required']) !!}
                            @if($errors->has('nid'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>@endif
                        </div>
                        {!! Form::hidden('action', 'send_nid') !!}
                        {!! Form::hidden('vid', $voteEvent->id) !!}
                        {!! Form::submit('送出', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection