@extends('app')

@section('title')
    新增投票所
@endsection

@section('content')
    <div class="container" style="min-height: 600px">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">新增投票所</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            {!! Form::open(['route' => 'booth.store', 'class' => 'form-horizontal']) !!}
                                <div class="form-group has-feedback{{ ($errors->has('name'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="name">名稱</label>
                                    <div class="col-md-9">
                                        {!! Form::text('name', null, ['id' => 'name', 'placeholder' => '請輸入投票所名稱', 'class' => 'form-control', 'required']) !!}
                                        @if($errors->has('name'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('name') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('url'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="url">頻道網址</label>
                                    <div class="col-md-9">
                                        {!! Form::url('url', null, ['id' => 'url', 'placeholder' => '請輸入Youtube直播頻道網址', 'class' => 'form-control', 'required']) !!}
                                        @if($errors->has('url'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('url') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-2">
                                        {!! Form::submit('新增投票所', ['class' => 'btn btn-primary']) !!}
                                        {!! HTML::linkRoute('booth.index', '返回', [], ['class' => 'btn btn-default']) !!}
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
