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
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#login" aria-controls="home" role="tab" data-toggle="tab">登入</a></li>
                            <li role="presentation"><a href="#register" aria-controls="profile" role="tab" data-toggle="tab">註冊</a></li>
                        </ul>
                    </div>
                    <!-- Tab panes + Panel body -->
                    <div class="panel-body tab-content">
                        <div role="tabpanel" class="tab-pane active" id="login">登入</div>
                        <div role="tabpanel" class="tab-pane" id="register">註冊</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
