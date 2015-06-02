@extends('app')

@section('title')
    投票選項清單
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">投票選項清單</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        @if(Auth::check() && Auth::user()->isStaff())
                            {!! HTML::linkRoute('vote-selection.create', '新增投票選項', ['vid' => Input::get('vid')], ['class' => 'btn btn-primary
                            pull-right']) !!}
                        @endif
                        <table class="table table-hover" style="margin-top: 5px">
                            <thead>
                            <tr>
                                <th class="col-md-2" colspan="2">投票活動：{!! HTML::linkRoute('vote-event.show', $voteEvent->subject, $voteEvent->id, null) !!}</th>
                            </tr>
                            <tr>
                                <th class="col-md-10 text-center">投票項目</th>
                                <th class="col-md-2"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($voteEvent->voteSelections as $voteSelectionItem)
                                <tr class="classData">
                                    <td>
                                        @if($voteSelectionItem->card != null)
                                            {{ $voteSelectionItem->card->getName() }}
                                            <a href="{{ URL::route('card.show', $voteSelectionItem->card->id) }}" title="卡片資料"><i class="glyphicon glyphicon-credit-card"></i></a>
                                        @else
                                            {{ $voteSelectionItem->alt_text }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        {!! link_to_route('vote-selection.edit', '編輯', $voteSelectionItem->id, ['class' => 'btn btn-default']) !!}
                                        {!! Form::open(['route' => ['vote-selection.destroy', $voteSelectionItem->id], 'style' => 'display: inline', 'method' => 'DELETE',
                                        'onSubmit' => "return confirm('確定要刪除此投票選項嗎？');"]) !!}
                                        {!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
