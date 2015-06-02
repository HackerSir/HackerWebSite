@extends('app')

@section('title')
    新增投票選項
@endsection

@section('content')
    <div class="container" style="min-height: 600px">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">新增投票選項</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            {!! Form::open(['route' => 'vote-selection.store', 'class' => 'form-horizontal']) !!}
                                <div class="form-group">
                                    <label class="control-label col-md-3" for="creator">投票活動</label>
                                    <div class="col-md-9">
                                        {!! HTML::linkRoute('vote-event.show', $voteEvent->subject, $voteEvent->id, null) !!}
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('nid'))?' has-error':'' }}">
                                    <label class="control-label col-md-3" for="nid">候選人NID</label>
                                    <div class="col-md-9">
                                        {!! Form::text('nid', null, ['id' => 'nid', 'placeholder' => '請輸入候選人NID，不輸入則顯示下方替代文字', 'class' => 'form-control']) !!}
                                        @if($errors->has('nid'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('nid') }}</span><br />@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('alt_text'))?' has-error':'' }}">
                                    <label class="control-label col-md-3" for="alt_text">替代文字</label>
                                    <div class="col-md-9">
                                        {!! Form::text('alt_text', null, ['id' => 'alt_text', 'placeholder' => '請輸入替代文字', 'class' => 'form-control']) !!}
                                        @if($errors->has('alt_text'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('alt_text') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-3">
                                        {!! Form::hidden('vid', $voteEvent->id) !!}
                                        {!! Form::submit('新增投票選項', ['class' => 'btn btn-primary']) !!}
                                        {!! HTML::linkRoute('vote-selection.index', '返回', ['vid' => $voteEvent->id], ['class' => 'btn btn-default']) !!}
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

