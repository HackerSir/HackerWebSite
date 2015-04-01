@extends('app')

@section('title')
    編輯課程資料
@endsection

@section('content')
    <div class="container" style="min-height: 600px">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
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
                                        <span class="label label-danger">{{ $errors->first('lecturer') }}</span><br />@endif
                                        <span class="label label-primary">若講師為會員，可直接輸入<span title="從成員清單進入該成員頁面時，網址最後面的數字。<br />你的UID為 {{ Auth::user()->id }}" style="color: #ffff00">數字UID</span>，否則請直接輸入全名</span>
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('time'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="time">日期時間</label>
                                    <div class="col-md-9">
                                        <div class='input-group date' id='datetimepicker'>
                                            {!! Form::text('time', $course->time, ['id' => 'time', 'placeholder' => 'YYYY/MM/DD HH:mm:ss', 'class' => 'form-control', 'required']) !!}
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        @if($errors->has('time'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('time') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('location'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="location">課程地點</label>
                                    <div class="col-md-9">
                                        {!! Form::text('location', $course->location, ['id' => 'location', 'placeholder' => '請輸入課程地點', 'class' => 'form-control']) !!}
                                        @if($errors->has('location'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('location') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('tag'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="tag">分類標籤</label>
                                    <div class="col-md-9">
                                        {!! Form::text('tag', implode(",", $course->tagNames()), ['id' => 'tag', 'placeholder' => '請輸入分類標籤（多個請以半形逗號分隔）', 'class' => 'form-control']) !!}
                                        @if($errors->has('tag'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('tag') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('link'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="link">相關連結</label>
                                    <div class="col-md-9">
                                        {!! Form::textarea('link', $course->link, ['id' => 'link', 'placeholder' => '請輸入相關連結，每行一個網址', 'class' => 'form-control', 'rows' => 5]) !!}
                                        @if($errors->has('link'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('link') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('info'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="info">內容簡介</label>
                                    <div class="col-md-9" role="tabpanel">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#edit" aria-controls="edit" role="tab" data-toggle="tab" id="tab_edit">編輯</a></li>
                                            <li role="presentation"><a href="#preview" aria-controls="preview" role="tab" data-toggle="tab" id="tab_preview">預覽</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-12">
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="edit">
                                                {!! Form::textarea('info', $course->info, ['id' => 'info', 'placeholder' => '請輸入內容簡介', 'class' => 'form-control']) !!}
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="preview">
                                                Loading...
                                            </div>
                                        </div>
                                        @if($errors->has('info'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('info') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-10 col-md-offset-1 text-center">
                                        <hr />
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

@section('javascript')
    $(function () {
        $('#datetimepicker').datetimepicker({
            format: 'YYYY/MM/DD HH:mm:ss'
        });
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // e.target -> newly activated tab
        if(e.target.id == 'tab_preview'){
            $("#preview").html("Loading...");

            var URLs = "{{ URL::route('markdown.preview') }}"
            var val = $('#edit textarea').val();

            $.ajax({
                url: URLs,
                data: val,
                headers: {
                    'X-CSRF-Token': "{{ Session::token() }}" ,
                    "Accept": "application/json"
                },
                type:"POST",
                dataType: "text",

                success: function(data){
                    if(data){
                        $("#preview").html(data);
                    }else{
                        alert("error");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }
    })
@endsection
