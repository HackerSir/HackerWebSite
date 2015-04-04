@extends('app')

@section('title')
    編輯卡片資料
@endsection

@section('content')
    <div class="container" style="min-height: 600px">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">編輯卡片資料</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            {!! Form::open(['route' => ['card.update', $card->id], 'class' => 'form-horizontal', 'method' => 'PUT']) !!}
                                <div class="form-group has-feedback{{ ($errors->has('nid'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="nid">NID</label>
                                    <div class="col-md-9">
                                        {!! Form::text('nid', $card->nid, ['id' => 'nid', 'placeholder' => '請輸入卡片NID', 'class' => 'form-control', 'required', 'readonly']) !!}
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('grade'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="grade">系級</label>
                                    <div class="col-md-9">
                                        {!! Form::text('grade', $card->grade, ['id' => 'grade', 'placeholder' => '請輸入系級', 'class' => 'form-control']) !!}
                                        @if($errors->has('grade'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('grade') }}</span><br />@endif
                                        <span class="label label-primary">若此卡片屬於會員，則系級直接由會員資料取得，無須填寫</span>
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('name'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="name">姓名</label>
                                    <div class="col-md-9">
                                        {!! Form::text('name', $card->name, ['id' => 'name', 'placeholder' => '請輸入姓名', 'class' => 'form-control']) !!}
                                        @if($errors->has('name'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('name') }}</span><br />@endif
                                        <span class="label label-primary">若此卡片屬於會員，則姓名直接由會員資料取得，無須填寫</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-10 col-md-offset-1 text-center">
                                        <hr />
                                        {!! Form::submit('修改資料', ['class' => 'btn btn-primary']) !!}
                                        {!! HTML::linkRoute('card.show', '返回', $card->id, ['class' => 'btn btn-default']) !!}
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
