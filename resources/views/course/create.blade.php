@extends('app')

@section('title')
    新增課程資料
@endsection

@section('content')
    <div class="container" style="min-height: 600px">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">新增課程資料</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            {!! Form::open(['route' => 'course.store', 'class' => 'form-horizontal']) !!}
                                <div class="form-group has-feedback{{ ($errors->has('subject'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="subject">課程名稱</label>
                                    <div class="col-md-9">
                                        {!! Form::text('subject', null, ['id' => 'subject', 'placeholder' => '請輸入課程名稱', 'class' => 'form-control', 'required']) !!}
                                        @if($errors->has('subject'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('subject') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('description'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="description">課程簡介</label>
                                    <div class="col-md-9">
                                        {!! Form::text('description', null, ['id' => 'description', 'placeholder' => '請輸入課程簡介', 'class' => 'form-control']) !!}
                                        @if($errors->has('description'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('description') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('lecturer'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="lecturer">課程講師</label>
                                    <div class="col-md-9">
                                        {!! Form::text('lecturer', null, ['id' => 'lecturer', 'placeholder' => '請輸入課程講師', 'class' => 'form-control']) !!}
                                        @if($errors->has('lecturer'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('lecturer') }}</span><br />@endif
                                        <span class="label label-primary">若講師為會員，可直接輸入<span title="從成員清單進入該成員頁面時，網址最後面的數字。<br />你的UID為 {{ Auth::user()->id }}" style="color: #ffff00">數字UID</span>，否則請直接輸入全名</span>
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
                                <div class="form-group has-feedback{{ ($errors->has('location'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="location">課程地點</label>
                                    <div class="col-md-9">
                                        {!! Form::text('location', null, ['id' => 'location', 'placeholder' => '請輸入課程地點', 'class' => 'form-control']) !!}
                                        @if($errors->has('location'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('location') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('tag'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="tag">分類標籤</label>
                                    <div class="col-md-9">
                                        <select name="tag[]" id="tag" class="form-control" multiple>
                                            @foreach(App\Course::existingTags() as $tag)
                                                <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('tag'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('tag') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-2">
                                        {!! Form::submit('新增課程', ['class' => 'btn btn-primary']) !!}
                                        {!! HTML::linkRoute('course.index', '返回', [], ['class' => 'btn btn-default']) !!}
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

    $('#tag').select2({
        placeholder: "請輸入分類標籤（多個請以半形逗號分隔）",
        multiple: true,
        tags: true,
        tokenSeparators: [',', ' ']
    });
@endsection
