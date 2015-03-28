@extends('app')

@section('title')
    {{ $candidate->name }} - 候選人資料
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $candidate->name }} - 候選人資料</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="text-center col-md-12 col-md-offset-0">
                                <table class="table table-hover">
                                    <tr>
                                        <td>號碼：</td>
                                        <td>{{ $candidate->number }}</td>
                                    </tr>
                                    <tr>
                                        <td>職稱：</td>
                                        <td>{{ $candidate->job }}</td>
                                    </tr>
                                    <tr>
                                        <td>姓名：</td>
                                        <td>{{ $candidate->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>系所：</td>
                                        <td>{{ $candidate->department }}</td>
                                    </tr>
                                    <tr>
                                        <td>班級：</td>
                                        <td>{{ $candidate->class }}</td>
                                    </tr>
                                    <tr>
                                        <td>投票類型：</td>
                                        <td>{{ $candidate->type }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            {!! HTML::linkRoute('candidate.edit', '編輯候選人資料', $candidate->id, ['class' => 'btn btn-primary']) !!}
                                            {!! HTML::linkRoute('candidate.index', '返回候選人列表', [], ['class' => 'btn btn-default']) !!}
                                            {!! Form::open(['route' => ['candidate.destroy', $candidate->id], 'style' => 'display: inline', 'method' => 'DELETE',
                                            'onSubmit' => "return confirm('確定要刪除候選人嗎？');"]) !!}
                                            {!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
