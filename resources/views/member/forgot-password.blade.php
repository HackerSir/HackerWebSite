@extends('app')

@section('title')
    找回密碼
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">找回密碼</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        {!! Form::open(['route' => 'member.forgot-password']) !!}
                            <div class="form-group has-feedback{{ ($errors->has('email'))?' has-error':'' }}">
                                <label class="control-label" for="email">信箱
                                    @if($errors->has('email'))
                                        <span class="label label-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </label>
                                {!! Form::email('email', null, ['id' => 'email', 'placeholder' => '請輸入信箱', 'class' => 'form-control', 'required']) !!}
                                @if($errors->has('email'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>@endif
                            </div>
                            {!! Form::submit('找回密碼', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
