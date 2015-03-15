@extends('app')

@section('title')
    成員清單
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">成員清單</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th width="40"></th>
                                <th>暱稱</th>
                                <th>姓名</th>
                                <th>群組</th>
                                <th>職稱</th>
                                <th>系級</th>
                                <th>信箱</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userList as $userItem)
                                <tr>
                                    <td>{!! HTML::image($userItem->gravatar(40), null, ['class' => 'img-circle']) !!}</td>
                                    <td>{{ $userItem->nickname }}</td>
                                    <td>{{ $userItem->name }}</td>
                                    <td>{{ $userItem->group->title }}</td>
                                    <td>{{ $userItem->job }}</td>
                                    <td>{{ $userItem->grade }}</td>
                                    <td>{{ $userItem->email }}
                                        @if($userItem->isConfirmed())
                                            <span class="label label-success">已驗證</span>
                                        @else
                                            <span class="label label-danger">未驗證</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {!! str_replace('/?', '?', $userList->render()); !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
