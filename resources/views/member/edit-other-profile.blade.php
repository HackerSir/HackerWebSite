@extends('app')

@section('title')
    編輯資料
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">編輯資料</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="text-center">
                                {{-- Gravatar大頭貼 --}}
                                {!! HTML::image($showUser->gravatar(), null, ['class' => 'img-circle']) !!}
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            {!! Form::open(['route' => ['member.edit-other-profile', $showUser->id], 'class' => 'form-horizontal']) !!}
                            <div class="form-group">
                                <label class="control-label col-md-2" for="name">Email</label>
                                <div class="col-md-9">
                                    {!! Form::email('email', $showUser->email, ['id' => 'email', 'placeholder' => '信箱', 'class' => 'form-control', 'readonly']) !!}
                                    <span class="label label-primary">信箱作為帳號使用，故無法修改</span>
                                </div>
                            </div>
                            <div class="form-group has-feedback{{ ($errors->has('name'))?' has-error':'' }}">
                                <label class="control-label col-md-2" for="name">真實姓名</label>
                                <div class="col-md-9">
                                    {!! Form::text('name', $showUser->name, ['id' => 'name', 'placeholder' => '請輸入真實姓名', 'class' => 'form-control']) !!}
                                    @if($errors->has('name'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                    <span class="label label-danger">{{ $errors->first('name') }}</span><br />@endif
                                    <span class="label label-primary">若清空此欄位，該用戶將可再次設定真實姓名</span>
                                </div>
                            </div>
                                <div class="form-group has-feedback{{ ($errors->has('nickname'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="nickname">暱稱</label>
                                    <div class="col-md-9">
                                        {!! Form::text('nickname', $showUser->nickname, ['id' => 'nickname', 'placeholder' => '請輸入暱稱', 'class' => 'form-control', 'required']) !!}
                                        @if($errors->has('nickname'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('nickname') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('nid'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="nid">NID</label>
                                    <div class="col-md-9">
                                        {!! Form::text('nid', $showUser->nid, ['id' => 'nid', 'placeholder' => '請輸入NID', 'class' => 'form-control']) !!}
                                        @if($errors->has('nid'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('nid') }}</span><br />@endif
                                        <span class="label label-primary">若清空此欄位，該用戶將可再次設定NID</span>
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('grade'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="grade">系級</label>
                                    <div class="col-md-9">
                                        {!! Form::text('grade', $showUser->grade, ['id' => 'grade', 'placeholder' => '請輸入系級', 'class' => 'form-control']) !!}
                                        @if($errors->has('grade'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('grade') }}</span>@endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('group'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="group">用戶組</label>
                                    <div class="col-md-9">
                                        @if($showUser->id != $user->id)
                                            {!! Form::select('group',$groupList, $showUser->group->name, ['class' => 'form-control']) !!}
                                            @if($errors->has('group'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                            <span class="label label-danger">{{ $errors->first('group') }}</span>@endif
                                        @else
                                            {!! Form::select('group',$groupList, $showUser->group->name, ['class' => 'form-control', 'disabled']) !!}
                                            {!! Form::hidden('group', $showUser->group->name) !!}
                                            <span class="label label-primary">禁止解除自己的幹部職務</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback{{ ($errors->has('job'))?' has-error':'' }}">
                                    <label class="control-label col-md-2" for="job">職務</label>
                                    <div class="col-md-9">
                                        {!! Form::text('job', $showUser->job, ['id' => 'job', 'placeholder' => '請輸入在社團內擔任的職務', 'class' => 'form-control']) !!}
                                        @if($errors->has('job'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span class="label label-danger">{{ $errors->first('job') }}</span><br />@endif
                                        <span class="label label-primary">此欄位僅對幹部有效</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-2">
                                        {!! Form::submit('修改資料', ['class' => 'btn btn-primary']) !!}
                                        {!! HTML::linkRoute('member.profile', '返回', $showUser->id, ['class' => 'btn btn-default']) !!}
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
