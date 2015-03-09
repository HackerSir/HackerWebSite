@extends('app')

@section('title')
    編輯個人資料
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">編輯個人資料</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="text-center">
                                {{-- Gravatar大頭貼 --}}
                                {!! HTML::image($user->gravatar(), null, ['class' => 'img-circle']) !!}
                                <br />
                                <br />
                                {!! HTML::link('http://zh-tw.gravatar.com/', '透過Gravatar更換大頭貼', ['class' => 'btn btn-primary', 'target' => '_blank']) !!}
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            {!! Form::open(['route' => 'member.edit-profile', 'class' => 'form-horizontal']) !!}
                                <div class="form-group has-feedback{{ ($errors->has('nickname'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="nickname">暱稱</label>
                                    <div class="col-md-9">
                                        {!! Form::text('nickname', $user->nickname, ['id' => 'nickname', 'placeholder' => '請輸入暱稱', 'class' => 'form-control', 'required']) !!}
                                        @if($errors->has('nickname'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('nickname') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('name'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="name">真實姓名</label>
                                    <div class="col-md-9">
                                        @if(empty($user->name))
                                            {!! Form::text('name', $user->name, ['id' => 'name', 'placeholder' => '請輸入真實姓名', 'class' => 'form-control']) !!}
                                            @if($errors->has('name'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                            <span class="label label-danger">{{ $errors->first('name') }}</span><br />@endif
                                        @else
                                            {!! Form::text(null, $user->name, ['id' => 'name', 'placeholder' => '請輸入真實姓名', 'class' => 'form-control', 'readonly']) !!}
                                        @endif
                                        <span class="label label-primary">真實姓名僅能設定一次，設定後將無法修改</span>
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('nid'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="nid">NID</label>
                                    <div class="col-md-9">
                                        @if(empty($user->nid))
                                            {!! Form::text('nid', $user->nid, ['id' => 'nid', 'placeholder' => '請輸入NID', 'class' => 'form-control']) !!}
                                            @if($errors->has('nid'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                            <span class="label label-danger">{{ $errors->first('nid') }}</span><br />@endif
                                        @else
                                            {!! Form::text(null, $user->nid, ['id' => 'nid', 'placeholder' => '請輸入NID', 'class' => 'form-control', 'readonly']) !!}
                                        @endif
                                        <span class="label label-primary">NID僅能設定一次，設定後將無法修改</span>
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('grade'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="grade">系級</label>
                                    <div class="col-md-9">
                                        {!! Form::text('grade', $user->grade, ['id' => 'grade', 'placeholder' => '請輸入系級', 'class' => 'form-control']) !!}
                                        @if($errors->has('grade'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('grade') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-2">
                                        {!! Form::submit('修改資料', ['class' => 'btn btn-primary']) !!}
                                        {!! HTML::linkRoute('member.profile', '返回', null, ['class' => 'btn btn-default']) !!}
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
