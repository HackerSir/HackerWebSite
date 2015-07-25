@extends('app')

@section('title')
    新增簽到資料
@endsection

@section('content')
    <div class="container" style="min-height: 600px">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">新增簽到資料</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            {!! Form::open(['route' => ['signin.store', $course->id], 'class' => 'form-horizontal']) !!}
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="subject">課程名稱</label>
                                    <div class="col-md-9">
                                        {!! HTML::linkRoute('course.show', $course->subject, $course->id, null) !!}
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('time'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="time">日期時間</label>
                                    <div class="col-md-9">
                                        <div class='input-group date' id='datetimepicker'>
                                            {!! Form::text('time', null, ['id' => 'time', 'placeholder' => 'YYYY/MM/DD HH:mm:ss', 'class' => 'form-control', 'required']) !!}
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        @if($errors->has('time'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('time') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('nid'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="nid">NID清單</label>
                                    <div class="col-md-9">
                                        {!! Form::textarea('nid', $course->nid, ['id' => 'nid', 'placeholder' => '請輸入NID清單，每行一個NID', 'class' => 'form-control', 'rows' => 20, 'required']) !!}
                                        @if($errors->has('nid'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('nid') }}</span><br />@endif
                                        <span class="label label-primary">無卡片資料之NID，將自動建立卡片資料</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-2">
                                        {!! Form::submit('新增簽到資料', ['class' => 'btn btn-primary']) !!}
                                        {!! HTML::linkRoute('course.show', '返回', $course->id, ['class' => 'btn btn-default']) !!}
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
        $('#datetimepicker').datetimepicker({
            format: 'YYYY/MM/DD HH:mm:ss'
        });
    });
@endsection
