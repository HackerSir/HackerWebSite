@extends('app')

@section('title')
    {{ $course->subject }} - 課程資料
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $course->subject }} - 課程資料</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="text-center col-md-10 col-md-offset-1">
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
                                        <td colspan="2">
                                            {!! HTML::linkRoute('course.edit', '編輯課程資料', $course->id, ['class' => 'btn btn-primary']) !!}
                                            {!! HTML::linkRoute('course.index', '返回課程列表', [], ['class' => 'btn btn-default']) !!}
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
