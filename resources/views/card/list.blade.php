@extends('app')

@section('title')
    卡片清單
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">卡片清單</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        {!! HTML::linkRoute('card.create', '新增卡片', [], ['class' => 'btn btn-primary pull-right']) !!}
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-3">NID</th>
                                <th class="col-md-4">會員資料</th>
                                <th class="col-md-2">系級</th>
                                <th class="col-md-2">姓名</th>
                                <th class="col-md-1">卡號</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cardList as $cardItem)
                                <tr>
                                    <td>{!! HTML::linkRoute('card.show', $cardItem->nid, $cardItem->id, null) !!}</td>
                                    <td>
                                        @if($cardItem->user() != null)
                                            {!! link_to_route('member.profile', $cardItem->user()->nickname, $cardItem->user()->id) !!}
                                        @endif
                                    </td>
                                    <td>{{ $cardItem->getGrade() }}</td>
                                    <td>{{ $cardItem->getName() }}</td>
                                    <td>
                                        @if(!empty($cardItem->card_number))
                                            <i class="glyphicon glyphicon-ok" title="卡片已綁定" style="color: green;"></i>
                                        @else
                                            <i class="glyphicon glyphicon-remove" title="卡片未綁定" style="color: red;"></i>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {!! str_replace('/?', '?', $cardList->appends(Input::except(array('page')))->render()); !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
