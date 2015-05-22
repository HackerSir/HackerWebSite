@extends('app')

@section('title')
    課程清單
@endsection

@section('head')
    {!! HTML::style('css/no-more-table.css'); !!}
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
            .noMoreTable td:nth-of-type(1):before { content: "課程"; }
            .noMoreTable td:nth-of-type(2):before { content: "簽到資訊"; }
            .noMoreTable td:nth-of-type(3):before { content: "講師"; }
            .noMoreTable td:nth-of-type(4):before { content: "時間"; }
            .noMoreTable td:nth-of-type(5):before { content: "地點"; }
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">課程清單</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        @if(Auth::check() && Auth::user()->isStaff())
                            {!! HTML::linkRoute('course.create', '新增課程', [], ['class' => 'btn btn-primary pull-right']) !!}
                        @endif
                        <div class="btn-toolbar" role="toolbar" aria-label="TagBar">
                            <div class="btn-group" role="group" aria-label="All">
                                @if(Input::has('tag'))
                                    {!! HTML::linkRoute('course.index', '所有課程', [], ['class' => 'btn btn-info']) !!}
                                @else
                                    {!! HTML::linkRoute('course.index', '所有課程', [], ['class' => 'btn btn-info active']) !!}
                                @endif
                            </div>
                            <div class="btn-group" role="group" aria-label="Tag">
                                @foreach($existingTags as $tag)
                                    @if(Input::get('tag')==$tag->name)
                                        {!! HTML::linkRoute('course.index', $tag->name, ['tag' => $tag->name], ['class' => 'btn btn-info active']) !!}
                                    @else
                                        {!! HTML::linkRoute('course.index', $tag->name, ['tag' => $tag->name], ['class' => 'btn btn-info']) !!}
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <table class="table table-hover noMoreTable">
                            <thead>
                            <tr>
                                <th class="col-md-5">課程</th>
                                <th class="col-md-1"></th>
                                <th class="col-md-2">講師</th>
                                <th class="col-md-2">時間</th>
                                <th class="col-md-2">地點</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courseList as $courseItem)
                                <tr class="classData">
                                    <td>
                                        @foreach($courseItem->tagNames() as $tag)<span class="label label-info">{{ $tag }}</span> @endforeach
                                        {!! HTML::linkRoute('course.show', $courseItem->subject, $courseItem->id, null) !!}
                                        @if(!empty($courseItem->description))
                                            <br />
                                            >>> {{ $courseItem->description }}
                                        @endif
                                    </td>
                                    <td class="text-right" style="min-height: 37px;">
                                        @if(count($courseItem->signins))
                                            @if($courseItem->check(Auth::user()))
                                                <i class="glyphicon glyphicon-ok" title="已簽到"></i>
                                            @endif
                                            @if(Auth::check() && Auth::user()->isStaff())
                                                <span class="badge" title="簽到人數">{{ count($courseItem->signins) }}</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if(App\User::find($courseItem->lecturer))
                                            {!! link_to_route('member.profile', App\User::find($courseItem->lecturer)->nickname, App\User::find($courseItem->lecturer)->id) !!}
                                        @else
                                            {{ $courseItem->lecturer }}
                                        @endif
                                    </td>
                                    <td>{{ $courseItem->time }}</td>
                                    <td>{{ $courseItem->location }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {!! str_replace('/?', '?', $courseList->appends(Input::except(array('page')))->render()); !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
