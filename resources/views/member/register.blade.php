@extends('app')

@section('title')
    註冊
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">註冊</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        {{-- 註冊 --}}
                        {!! Form::open(['route' => 'member.register']) !!}
                            <div class="form-group has-feedback{{ ($errors->has('email'))?' has-error':'' }}">
                                <label class="control-label" for="email">信箱
                                    @if($errors->has('email'))
                                        <span class="label label-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </label>
                                {!! Form::email('email', null, ['id' => 'email', 'placeholder' => '請輸入信箱', 'class' => 'form-control', 'required']) !!}
                                @if($errors->has('email'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>@endif
                            </div>
                            <div class="form-group has-feedback{{ ($errors->has('password'))?' has-error':'' }}">
                                <label class="control-label" for="password">密碼
                                    @if($errors->has('password'))
                                        <span class="label label-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </label>
                                {!! Form::password('password', ['id' => 'password', 'placeholder' => '請輸入密碼', 'class' => 'form-control', 'required']) !!}
                                @if($errors->has('password'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>@endif
                            </div>
                            <div class="form-group has-feedback{{ ($errors->has('password_again'))?' has-error':'' }}">
                                <label class="control-label" for="password_again">密碼（再輸入一次）
                                    @if($errors->has('password_again'))
                                        <span class="label label-danger">{{ $errors->first('password_again') }}</span>
                                    @endif
                                </label>
                                {!! Form::password('password_again', ['id' => 'password_again', 'placeholder' => '請再輸入一次密碼', 'class' => 'form-control', 'required']) !!}
                                @if($errors->has('password_again'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>@endif
                            </div>
                            {!! Form::submit('註冊', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ URL::route('member.login') }}">登入</a>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
