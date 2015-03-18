@extends('app')

@section('title')
    編輯課程資料
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">編輯課程資料</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            {!! Form::open(['route' => ['course.update', $course->id], 'class' => 'form-horizontal', 'method' => 'PUT']) !!}
                                <div class="form-group has-feedback{{ ($errors->has('subject'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="subject">課程名稱</label>
                                    <div class="col-md-9">
                                        {!! Form::text('subject', $course->subject, ['id' => 'subject', 'placeholder' => '請輸入課程名稱', 'class' => 'form-control', 'required']) !!}
                                        @if($errors->has('subject'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('subject') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('lecturer'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="lecturer">課程講師</label>
                                    <div class="col-md-9">
                                        {!! Form::text('lecturer', $course->lecturer, ['id' => 'lecturer', 'placeholder' => '請輸入課程講師', 'class' => 'form-control']) !!}
                                        @if($errors->has('lecturer'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('lecturer') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('time'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="time">日期時間</label>
                                    <div class="col-md-9">
                                        {!! Form::text('time', $course->time, ['id' => 'time', 'placeholder' => '請輸入日期時間', 'class' => 'form-control', 'required']) !!}
                                        @if($errors->has('time'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('time') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-2">
                                        {!! Form::submit('修改資料', ['class' => 'btn btn-primary']) !!}
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
