@extends('app')

@section('title')
    重新設定密碼
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">重新設定密碼</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        {!! Form::open(['route' => 'member.reset-password']) !!}
                            <div class="form-group">
                                <label class="control-label" for="email">信箱</label>
                                {!! Form::email('email', $user->email, ['id' => 'email', 'placeholder' => '信箱', 'class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group has-feedback{{ ($errors->has('password'))?' has-error':'' }}">
                                <label class="control-label" for="password">新密碼
                                    @if($errors->has('password'))
                                        <span class="label label-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </label>
                                {!! Form::password('password', ['id' => 'password', 'placeholder' => '請輸入新密碼', 'class' => 'form-control', 'required']) !!}
                                @if($errors->has('password'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>@endif
                            </div>
                            <div class="form-group has-feedback{{ ($errors->has('password_again'))?' has-error':'' }}">
                                <label class="control-label" for="password_again">新密碼（再輸入一次）
                                    @if($errors->has('password_again'))
                                        <span class="label label-danger">{{ $errors->first('password_again') }}</span>
                                    @endif
                                </label>
                                {!! Form::password('password_again', ['id' => 'password_again', 'placeholder' => '請再輸入一次新密碼', 'class' => 'form-control', 'required']) !!}
                                @if($errors->has('password_again'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>@endif
                            </div>
                            {!! Form::hidden('token',$token) !!}
                            {!! Form::submit('重新設定密碼', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
