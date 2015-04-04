@extends('app')

@section('title')
    {{ $card->nid }} - 卡片資料
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $card->nid }} - 卡片資料</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="text-center col-md-12 col-md-offset-0">
                                <table class="table table-hover">
                                    <tr>
                                        <th colspan="2">卡片資料</th>
                                    </tr>
                                    <tr>
                                        <td class="col-md-4">NID：</td>
                                        <td class="col-md-8">{{ $card->nid }}</td>
                                    </tr>
                                    <tr>
                                        <td>系級：</td>
                                        <td>{{ $card->grade }}</td>
                                    </tr>
                                    <tr>
                                        <td>姓名：</td>
                                        <td>{{ $card->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>卡號：</td>
                                        <td>
                                            @if(!empty($card->card_number))
                                                <span class="label label-success">卡片已綁定</span>
                                            @else
                                                <span class="label label-danger">卡片未綁定</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">會員資料</th>
                                    </tr>
                                    @if($card->user() != null)
                                        <tr>
                                            <td>暱稱：</td>
                                            <td>
                                                {!! link_to_route('member.profile', $card->user()->nickname, $card->user()->id) !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>系級：</td>
                                            <td>{{ $card->user()->grade }}</td>
                                        </tr>
                                        <tr>
                                            <td>姓名：</td>
                                            <td>{{ $card->user()->name }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="2">無會員使用此NID</td>
                                        </tr>
                                    @endif
                                </table>
                                <hr />
                                <div>
                                    {!! HTML::linkRoute('card.edit', '編輯卡片資料', $card->id, ['class' => 'btn btn-primary']) !!}
                                    {!! HTML::linkRoute('card.index', '返回卡片列表', [], ['class' => 'btn btn-default']) !!}
                                    {!! Form::open(['route' => ['card.destroy', $card->id], 'style' => 'display: inline', 'method' => 'DELETE',
                                    'onSubmit' => "return confirm('確定要刪除卡片嗎？');"]) !!}
                                    {!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
