@extends('app')

@section('title')
    課程清單
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">課程清單</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        {!! HTML::linkRoute('course.create', '新增課程', [], ['class' => 'btn btn-primary']) !!}
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-8">課程</th>
                                <th class="col-md-2">講師</th>
                                <th class="col-md-2">時間</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courseList as $courseItem)
                                <tr>
                                    <td>{!! HTML::linkRoute('course.show', $courseItem->subject, $courseItem->id, null) !!}</td>
                                    <td>{{ $courseItem->lecturer }}</td>
                                    <td>{{ $courseItem->time }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {!! str_replace('/?', '?', $courseList->render()); !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
