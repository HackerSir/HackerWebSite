@extends('app')

@section('title')
    {{ $booth->name }} - 投票所資料
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $booth->name }} - 投票所資料</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="text-center col-md-12 col-md-offset-0">
                                <table class="table table-hover">
                                    <tr>
                                        <td>投票所名稱：</td>
                                        <td>{{ $booth->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>直播頻道網址：</td>
                                        <td>{!! HTML::link($booth->url, $booth->url, ["target" => "_blank"]) !!}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            {!! HTML::linkRoute('booth.edit', '編輯投票所資料', $booth->id, ['class' => 'btn btn-primary']) !!}
                                            {!! HTML::linkRoute('booth.index', '返回投票所列表', [], ['class' => 'btn btn-default']) !!}
                                            {!! Form::open(['route' => ['booth.destroy', $booth->id], 'style' => 'display: inline', 'method' => 'DELETE',
                                            'onSubmit' => "return confirm('確定要刪除投票所嗎？');"]) !!}
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
