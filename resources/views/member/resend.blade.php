@extends('app')

@section('title')
    信箱驗證
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">信箱驗證</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        {!! Form::open(['route' => 'member.resend']) !!}
                            <div class="form-group">
                                <label class="control-label" for="email">信箱</label>
                                {!! Form::email('email', Auth::user()->email, ['id' => 'email', 'placeholder' => '信箱', 'class' => 'form-control', 'readonly']) !!}
                            </div>
                            {!! Form::submit('重新發送驗證信', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
