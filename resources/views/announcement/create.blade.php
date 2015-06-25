@extends('app')

@section('title')
    新增公告
@endsection

@section('content')
    <div class="container" style="min-height: 600px">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">新增公告</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            {!! Form::open(['route' => 'announcement.store', 'class' => 'form-horizontal']) !!}
                                <div class="form-group has-feedback{{ ($errors->has('title'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="title">主題</label>
                                    <div class="col-md-9">
                                        {!! Form::text('title', null, ['id' => 'title', 'placeholder' => '請輸入公告主題', 'class' => 'form-control', 'required']) !!}
                                        @if($errors->has('title'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('title') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('start_time'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="start_time">開始時間</label>
                                    <div class="col-md-9">
                                        <div class='input-group date' id='datetimepicker1'>
                                            {!! Form::text('start_time', null, ['id' => 'start_time', 'placeholder' => 'YYYY/MM/DD HH:mm:ss', 'class' => 'form-control']) !!}
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        @if($errors->has('start_time'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('start_time') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('end_time'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="end_time">結束時間</label>
                                    <div class="col-md-9">
                                        <div class='input-group date' id='datetimepicker2'>
                                            {!! Form::text('end_time', null, ['id' => 'end_time', 'placeholder' => 'YYYY/MM/DD HH:mm:ss', 'class' => 'form-control']) !!}
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        @if($errors->has('end_time'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('end_time') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('message'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="message">內容</label>
                                    <label class=" col-md-9" for="message">（支援HTML，自動換行）</label>
                                    <div class="col-md-12">
                                        {!! Form::textarea('message', null, ['id' => 'message', 'placeholder' => '請輸入內容', 'class' => 'form-control', 'required']) !!}
                                        @if($errors->has('message'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('message') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-2">
                                        {!! Form::submit('新增公告', ['class' => 'btn btn-primary']) !!}
                                        {!! HTML::linkRoute('announcement.index', '返回', [], ['class' => 'btn btn-default']) !!}
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

@section('javascript')
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY/MM/DD HH:mm:ss'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY/MM/DD HH:mm:ss'
        });
    });
@endsection

