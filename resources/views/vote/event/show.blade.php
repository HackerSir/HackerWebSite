@extends('app')

@section('title')
    {{ $voteEvent->subject }} - 投票活動
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $voteEvent->subject }} - 投票活動</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="text-center col-md-12 col-md-offset-0">
                                <table class="table table-hover">
                                    <tr>
                                        <td class="col-md-2">投票主題：</td>
                                        <td>{{ $voteEvent->subject }}</td>
                                    </tr>
                                    <tr>
                                        <td>投票地點：</td>
                                        <td>{{ $voteEvent->location }}</td>
                                    </tr>
                                    <tr>
                                        <td>開始時間：</td>
                                        <td>{{ $voteEvent->open_time }}</td>
                                    </tr>
                                    <tr>
                                        <td>結束時間：</td>
                                        <td>{{ $voteEvent->close_time }}</td>
                                    </tr>
                                    <tr>
                                        <td>建立者：</td>
                                        <td>
                                            {!! link_to_route('member.profile', $voteEvent->getCreator->nickname, $voteEvent->getCreator->id) !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>監票者：</td>
                                        <td>
                                            {!! link_to_route('member.profile', $voteEvent->getCreator->nickname, $voteEvent->getCreator->id) !!}
                                        </td>
                                    </tr>
                                </table>
                                <hr />
                                <div class="text-left">
                                    {!! Markdown::parse(htmlspecialchars($voteEvent->info)) !!}
                                </div>
                                <hr />
                                <div>
                                    @if(Auth::check() && Auth::user()->isStaff())
                                        {!! HTML::linkRoute('vote-event.edit', '編輯投票活動', $voteEvent->id, ['class' => 'btn btn-primary']) !!}
                                        {!! HTML::linkRoute('vote-event.index', '返回投票活動列表', [], ['class' => 'btn btn-default']) !!}
                                        {!! Form::open(['route' => ['vote-event.destroy', $voteEvent->id], 'style' => 'display: inline', 'method' => 'DELETE',
                                        'onSubmit' => "return confirm('確定要刪除投票活動嗎？');"]) !!}
                                        {!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    @else
                                        {!! HTML::linkRoute('course.index', '返回投票活動列表', [], ['class' => 'btn btn-default']) !!}
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
