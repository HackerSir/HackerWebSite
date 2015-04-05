@extends('app')

@section('title')
    {{ $course->subject }} - 課程資料
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $course->subject }} - 課程資料</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="text-center col-md-12 col-md-offset-0">
                                <table class="table table-hover">
                                    <tr>
                                        <td class="col-md-2">課程名稱：</td>
                                        <td>{{ $course->subject }}</td>
                                    </tr>
                                    <tr>
                                        <td>課程講師：</td>
                                        <td>
                                            @if(App\User::find($course->lecturer))
                                                {!! link_to_route('member.profile', App\User::find($course->lecturer)->nickname, App\User::find($course->lecturer)->id) !!}
                                            @else
                                                {{ $course->lecturer }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>日期時間：</td>
                                        <td>{{ $course->time }}</td>
                                    </tr>
                                    <tr>
                                        <td>課程地點：</td>
                                        <td>{{ $course->location }}</td>
                                    </tr>
                                    <tr>
                                        <td>分類標籤：</td>
                                        <td>@foreach($course->tagNames() as $tag)<span class="label label-info">{{ $tag }}</span> @endforeach</td>
                                    </tr>
                                    <tr>
                                        <td>相關連結：</td>
                                        <td>
                                            @foreach(preg_split("/((\r?\n)|(\r\n?))/", $course->link) as $line)
                                                {!! HTML::link($line, $line, ['target' => '_blank']) !!}<br />
                                            @endforeach
                                        </td>
                                    </tr>
                                </table>
                                <hr />
                                <div class="text-left">
                                    {!! Markdown::parse(htmlspecialchars($course->info)) !!}
                                </div>
                                <hr />
                                <div>
                                    @if(Auth::check() && Auth::user()->isStaff())
                                        {!! HTML::linkRoute('course.edit', '編輯課程資料', $course->id, ['class' => 'btn btn-primary']) !!}
                                        {!! HTML::linkRoute('course.index', '返回課程列表', [], ['class' => 'btn btn-default']) !!}
                                        {!! Form::open(['route' => ['course.destroy', $course->id], 'style' => 'display: inline', 'method' => 'DELETE',
                                        'onSubmit' => "return confirm('確定要刪除課程嗎？');"]) !!}
                                        {!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    @else
                                        {!! HTML::linkRoute('course.index', '返回課程列表', [], ['class' => 'btn btn-default']) !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(Auth::check() && Auth::user()->isStaff())
                    <div class="panel panel-danger">
                        <div class="panel-heading">簽到記錄（僅工作人員可見）</div>
                        {{-- Panel body --}}
                        <div class="panel-body">
                            <div class="row">
                                <div class="text-center col-md-12 col-md-offset-0">
                                    {!! HTML::linkRoute('signin.create', '新增簽到記錄', $course->id, ['class' => 'btn btn-primary pull-right']) !!}
                                    <table class="table table-hover">
                                        @if(count($course->signins))
                                            <thead>
                                                <tr>
                                                    <th>簽到者</th>
                                                    <th>系級</th>
                                                    <th>姓名</th>
                                                    <th>時間</th>
                                                    <th>操作</th>
                                                </tr>
                                            </thead>
                                            @foreach($course->signins as $signin)
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            @if($signin->card->user() != null)
                                                                {!! HTML::linkRoute('member.profile', $signin->card->user()->nickname, $signin->card->user()->id, []) !!}
                                                            @else
                                                                {{ $signin->card->nid }}
                                                            @endif
                                                            <a href="{{ URL::route('card.show', $signin->card->id) }}" title="卡片資料"><i class="glyphicon glyphicon-credit-card"></i></a>
                                                        </td>
                                                        <td>
                                                            {{ $signin->card->getGrade() }}
                                                        </td>
                                                        <td>
                                                            {{ $signin->card->getName() }}
                                                        </td>
                                                        <td>
                                                            {{ $signin->time }}
                                                        </td>
                                                        <td>
                                                            {!! Form::open(['route' => ['signin.destroy', $signin->id], 'style' => 'display: inline', 'method' => 'DELETE',
                                                            'onSubmit' => "return confirm('確定要刪除 ".$signin->card->getName()." 的簽到記錄嗎？');"]) !!}
                                                            {!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}
                                                            {!! Form::close() !!}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>無簽到記錄</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
