@extends('app')

@section('title')
    編輯候選人
@endsection

@section('content')
    <div class="container" style="min-height: 600px">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">編輯候選人</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            {!! Form::open(['route' => ['candidate.update', $candidate->id], 'class' => 'form-horizontal', 'method' => 'PUT']) !!}
                            <div class="form-group has-feedback{{ ($errors->has('number'))?' has-error':'' }}">
                                <label class="control-label col-md-2" for="number">號碼</label>
                                <div class="col-md-9">
                                    {!! Form::text('number', $candidate->number, ['id' => 'number', 'placeholder' => '請輸入候選人號碼', 'class' => 'form-control', 'required']) !!}
                                    @if($errors->has('number'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                    <span class="label label-danger">{{ $errors->first('number') }}</span><br />@endif
                                    <span class="label label-primary">若同類型投票中，有多個候選人使用相同號碼，則為同一組</span>
                                </div>
                            </div>
                            <div class="form-group has-feedback{{ ($errors->has('job'))?' has-error':'' }}">
                                <label class="control-label col-md-2" for="job">職稱</label>
                                <div class="col-md-9">
                                    {!! Form::text('job', $candidate->job, ['id' => 'job', 'placeholder' => '請輸入候選人職稱', 'class' => 'form-control']) !!}
                                    @if($errors->has('job'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                    <span class="label label-danger">{{ $errors->first('job') }}</span>@endif
                                </div>
                            </div>
                            <div class="form-group has-feedback{{ ($errors->has('name'))?' has-error':'' }}">
                                <label class="control-label col-md-2" for="name">姓名</label>
                                <div class="col-md-9">
                                    {!! Form::text('name', $candidate->name, ['id' => 'name', 'placeholder' => '請輸入候選人姓名', 'class' => 'form-control', 'required']) !!}
                                    @if($errors->has('name'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                    <span class="label label-danger">{{ $errors->first('name') }}</span>@endif
                                </div>
                            </div>
                            <div class="form-group has-feedback{{ ($errors->has('department'))?' has-error':'' }}">
                                <label class="control-label col-md-2" for="department">系所</label>
                                <div class="col-md-9">
                                    {!! Form::text('department', $candidate->department, ['id' => 'department', 'placeholder' => '請輸入候選人系所', 'class' => 'form-control', 'required']) !!}
                                    @if($errors->has('department'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                    <span class="label label-danger">{{ $errors->first('department') }}</span>@endif
                                </div>
                            </div>
                            <div class="form-group has-feedback{{ ($errors->has('class'))?' has-error':'' }}">
                                <label class="control-label col-md-2" for="class">班級</label>
                                <div class="col-md-9">
                                    {!! Form::text('class', $candidate->class, ['id' => 'class', 'placeholder' => '請輸入候選人班級', 'class' => 'form-control', 'required']) !!}
                                    @if($errors->has('class'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                    <span class="label label-danger">{{ $errors->first('class') }}</span>@endif
                                </div>
                            </div>
                            <div class="form-group has-feedback{{ ($errors->has('type'))?' has-error':'' }}">
                                <label class="control-label col-md-2" for="type">投票類型</label>
                                <div class="col-md-9">
                                    {!! Form::select('type', ["學生會會長"=>"學生會會長", "學生議員"=>"學生議員", "系會長"=>"系會長"], $candidate->type, ['class' => 'form-control']) !!}
                                    @if($errors->has('type'))<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                    <span class="label label-danger">{{ $errors->first('type') }}</span>@endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-2">
                                    {!! Form::submit('編輯候選人', ['class' => 'btn btn-primary']) !!}
                                    {!! HTML::linkRoute('candidate.show', '返回', $candidate->id, ['class' => 'btn btn-default']) !!}
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
