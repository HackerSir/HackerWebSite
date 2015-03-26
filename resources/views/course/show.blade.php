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
                                        <td>課程名稱：</td>
                                        <td>{{ $course->subject }}</td>
                                    </tr>
                                    <tr>
                                        <td>課程講師：</td>
                                        <td>{{ $course->lecturer }}</td>
                                    </tr>
                                    <tr>
                                        <td>日期時間：</td>
                                        <td>{{ $course->time }}</td>
                                    </tr>
                                    <tr>
                                        <td>分類標籤：</td>
                                        <td>@foreach($course->tagNames() as $tag)<span class="label label-info">{{ $tag }}</span> @endforeach</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            {!! HTML::linkRoute('course.edit', '編輯課程資料', $course->id, ['class' => 'btn btn-primary']) !!}
                                            {!! HTML::linkRoute('course.index', '返回課程列表', [], ['class' => 'btn btn-default']) !!}
                                            {!! Form::open(['route' => ['course.destroy', $course->id], 'style' => 'display: inline', 'method' => 'DELETE',
                                            'onSubmit' => "return confirm('確定要刪除課程嗎？');"]) !!}
                                            {!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @if($user->isStaff())
                    <div class="panel panel-danger">
                        <div class="panel-heading">簽到記錄（僅工作人員可見）</div>
                        {{-- Panel body --}}
                        <div class="panel-body">
                            <div class="row">
                                <div class="text-center col-md-12 col-md-offset-0">
                                    <table class="table table-hover">
                                        @if(count($course->signins))
                                            <tr>
                                                <td>簽到者</td>
                                                <td>時間</td>
                                            </tr>
                                            @foreach($course->signins as $signin)
                                                <tr>
                                                    <td>
                                                        {!! HTML::linkRoute('member.profile', $signin->card->user()->nickname, $signin->card->user()->id, []) !!}
                                                    </td>
                                                    <td>
                                                        {{ $signin->time }}
                                                    </td>
                                                </tr>
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
