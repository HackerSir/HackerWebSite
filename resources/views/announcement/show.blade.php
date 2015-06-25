@extends('app')

@section('title')
    {{ $announcement->title }} - 公告
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $announcement->title }} - 公告</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="text-center col-md-12 col-md-offset-0">
                                <table class="table table-hover">
                                    <tr>
                                        <td class="col-md-2">投票主題：</td>
                                        <td>
                                            {{ $announcement->title }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>開始時間：</td>
                                        <td>{{ $announcement->start_time }}</td>
                                    </tr>
                                    <tr>
                                        <td>結束時間：</td>
                                        <td>{{ $announcement->end_time }}</td>
                                    </tr>
                                </table>
                                <idv>（下方內容不解析HTML代碼，實際內容請見
                                    <a href="{{ route('enter-page', $announcement->id) }}" target="_blank">公告顯示頁面<i class="glyphicon glyphicon-new-window"></i></a>
                                    ）</idv>
                                <hr />
                                <div class="text-left">
                                    {!! nl2br(htmlspecialchars($announcement->message)) !!}
                                </div>
                                <hr />
                                <div>
                                    @if(Auth::check() && Auth::user()->isStaff())
                                        {!! HTML::linkRoute('announcement.edit', '編輯公告', $announcement->id, ['class' => 'btn btn-primary']) !!}
                                        {!! HTML::linkRoute('announcement.index', '返回公告列表', [], ['class' => 'btn btn-default']) !!}
                                        {!! Form::open(['route' => ['announcement.destroy', $announcement->id], 'style' => 'display: inline', 'method' => 'DELETE',
                                        'onSubmit' => "return confirm('確定要刪除公告嗎？');"]) !!}
                                        {!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    @else
                                        {!! HTML::linkRoute('announcement.index', '返回公告列表', [], ['class' => 'btn btn-default']) !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
