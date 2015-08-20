@extends('app')

@section('title')
    公告清單
@endsection

@section('css')
    {!! HTML::style('css/no-more-table.css') !!}
    <style type="text/css">
        @media
        only screen and (max-width: 479px) {
            .container {
                padding:0;
                margin:0;
            }

            /*
            Label the data
            */
            .noMoreTable td:nth-of-type(1):before { content: "主題"; }
            .noMoreTable td:nth-of-type(2):before { content: "開始時間"; }
            .noMoreTable td:nth-of-type(3):before { content: "結束時間"; }
            .noMoreTable td:nth-of-type(4):before { content: "建立時間"; }
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">公告清單</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        @if(Auth::check() && Auth::user()->isStaff())
                            {!! HTML::linkRoute('announcement.create', '新增公告', [], ['class' => 'btn btn-primary pull-right']) !!}
                        @endif
                        <table class="table table-hover noMoreTable" style="margin-top: 5px">
                            <thead>
                            <tr>
                                <th class="col-md-6">主題</th>
                                <th class="col-md-2">開始時間</th>
                                <th class="col-md-2">結束時間</th>
                                <th class="col-md-2">建立時間</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($announcementList as $announcementItem)
                                <tr class="classData">
                                    <td>{!! HTML::linkRoute('announcement.show', $announcementItem->title, $announcementItem->id, null) !!}</td>
                                    <td>{{ $announcementItem->start_time }}</td>
                                    <td>{{ $announcementItem->end_time }}</td>
                                    <td>{{ $announcementItem->updated_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {!! str_replace('/?', '?', $announcementList->appends(Input::except(array('page')))->render()) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
