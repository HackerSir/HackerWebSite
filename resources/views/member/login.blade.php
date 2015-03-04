@extends('app')

@section('title')
    登入
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{-- Nav tabs --}}
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#login" aria-controls="home" role="tab" data-toggle="tab">登入</a></li>
                            <li role="presentation"><a href="#register" aria-controls="profile" role="tab" data-toggle="tab">註冊</a></li>
                        </ul>
                    </div>
                    {{-- Tab panes + Panel body --}}
                    <div class="panel-body tab-content">
                        <div role="tabpanel" class="tab-pane active" id="login">
                            {{-- 登入 --}}
                            {!! Form::open(['route' => 'member.login']) !!}
                                <div class="form-group has-feedback {{ ($errors->has('email'))?'has-error':'' }}">
                                    <label for="email">信箱
                                        @if($errors->has('email'))
                                            <span class="label label-danger">{{ $errors->first('email') }}</span>
                                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                        @endif
                                    </label>
                                    {!! Form::email('email', null, ['placeholder' => '請輸入信箱', 'class' => 'form-control', 'required']) !!}
                                </div>
                                <div class="form-group has-feedback {{ ($errors->has('password'))?'has-error':'' }}">
                                    <label for="password">密碼 <a href="{{ URL::route('member.forgot-password') }}" tabindex="4">(忘記密碼)</a>
                                        @if($errors->has('password'))
                                            <span class="label label-danger">{{ $errors->first('password') }}</span>
                                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                        @endif
                                    </label>
                                    {!! Form::password('password', ['placeholder' => '請輸入密碼', 'class' => 'form-control', 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::checkbox('remember', 'remember') !!}
                                    {!! Form::label('remember', '記住我') !!}
                                </div>
                                {!! Form::submit('登入', ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </div>
                        <div role="tabpanel" class="tab-pane" id="register">
                            {{-- 註冊 --}}
                            {!! Form::open(['route' => 'member.register']) !!}
                            <div class="form-group has-feedback {{ ($errors->has('email'))?'has-error':'' }}">
                                <label for="email">信箱
                                    @if($errors->has('email'))
                                        <span class="label label-danger">{{ $errors->first('email') }}</span>
                                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                    @endif
                                </label>
                                {!! Form::email('email', null, ['placeholder' => '請輸入信箱', 'class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group has-feedback {{ ($errors->has('password'))?'has-error':'' }}">
                                <label for="password">密碼
                                    @if($errors->has('password'))
                                        <span class="label label-danger">{{ $errors->first('password') }}</span>
                                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                    @endif
                                </label>
                                {!! Form::password('password', ['placeholder' => '請輸入密碼', 'class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group has-feedback {{ ($errors->has('password_again'))?'has-error':'' }}">
                                <label for="password_again">密碼（再輸入一次）
                                    @if($errors->has('password_again'))
                                        <span class="label label-danger">{{ $errors->first('password_again') }}</span>
                                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                    @endif
                                </label>
                                {!! Form::password('password_again', ['placeholder' => '請再輸入一次密碼', 'class' => 'form-control', 'required']) !!}
                            </div>
                            {!! Form::submit('註冊', ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
