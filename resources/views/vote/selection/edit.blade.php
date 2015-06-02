@extends('app')

@section('title')
    編輯投票選項
@endsection

@section('content')
    <div class="container" style="min-height: 600px">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">編輯投票選項</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            {!! Form::open(['route' => ['vote-selection.update', $voteSelection->id], 'class' => 'form-horizontal', 'method' => 'PUT']) !!}
                                <div class="form-group">
                                    <label class="control-label col-md-3" for="creator">投票活動</label>
                                    <div class="col-md-9">
                                        {!! HTML::linkRoute('vote-event.show', $voteSelection->voteEvent->subject, $voteSelection->voteEvent->id, null) !!}
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('nid'))?' has-error':'' }}">
                                    <label class="control-label col-md-3" for="nid">候選人NID</label>
                                    <div class="col-md-9">
                                        {!! Form::text('nid', ($voteSelection->card)?$voteSelection->card->nid:null, ['id' => 'nid', 'placeholder' => '請輸入候選人NID，不輸入則顯示下方替代文字', 'class' => 'form-control']) !!}
                                        @if($errors->has('nid'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('nid') }}</span><br />@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('alt_text'))?' has-error':'' }}">
                                    <label class="control-label col-md-3" for="alt_text">替代文字</label>
                                    <div class="col-md-9">
                                        {!! Form::text('alt_text', $voteSelection->alt_text, ['id' => 'alt_text', 'placeholder' => '請輸入替代文字', 'class' => 'form-control']) !!}
                                        @if($errors->has('alt_text'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('alt_text') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-10 col-md-offset-1 text-center">
                                        <hr />
                                        {!! Form::submit('修改資料', ['class' => 'btn btn-primary']) !!}
                                        {!! HTML::linkRoute('vote-selection.index', '返回', ['vid' => $voteSelection->voteEvent->id], ['class' => 'btn btn-default']) !!}
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
