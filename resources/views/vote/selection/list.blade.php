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
                                <th class="col-md-2">投票活動：</th>
                                <th class="col-md-10" colspan="2">{!! HTML::linkRoute('vote-event.show', $voteEvent->subject, $voteEvent->id, null) !!}</th>
                            </tr>
                            <tr>
                                <th class="col-md-2">ID</th>
                                <th class="col-md-6">投票項目</th>
                                <th class="col-md-4">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($voteEvent->voteSelections as $voteSelectionItem)
                                <tr class="classData">
                                    <td>{{ $voteSelectionItem->id }}</td>
                                    <td>
                                        @if($voteSelectionItem->card != null)
                                            {{ $voteSelectionItem->card->name }}
                                        @else
                                            {{ $voteSelectionItem->alt_text }}
                                        @endif
                                    </td>
                                    <td>
                                        {!! link_to_route('vote-selection.edit', '編輯', $voteSelectionItem->id) !!}
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
