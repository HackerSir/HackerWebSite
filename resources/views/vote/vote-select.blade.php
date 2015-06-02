@extends('app')

@section('title')
    社團投票 - {{$voteEvent->subject}}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">投票畫面 {{$voteEvent->subject}} （投票者：{{ \Illuminate\Support\Facades\Session::get('nid') }}）</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        {{-- 登入 --}}
                        {!! Form::open(['route' => 'vote.user-vote']) !!}
                        <div class="form-group">
                            {!! Form::select('vote-select',$selectionList, null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        {!! Form::hidden('action', 'vote-selected') !!}
                        {!! Form::hidden('vid', $voteEvent->id) !!}
                        {!! Form::submit('送出', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}

                        {!! Form::open(['route' => 'vote.user-vote']) !!}
                        {!! Form::hidden('action', 'reset') !!}
                        {!! Form::hidden('vid', $voteEvent->id) !!}
                        {!! Form::submit('返回', ['class' => 'btn btn-default']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
