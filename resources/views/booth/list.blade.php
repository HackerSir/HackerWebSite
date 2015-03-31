@extends('app')

@section('title')
    投票所清單
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">投票所清單</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        {!! HTML::linkRoute('booth.create', '新增投票所', [], ['class' => 'btn btn-primary pull-right']) !!}
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="col-md-6">名稱</th>
                                    <th class="col-md-1">總開票數</th>
                                    <th class="col-md-5">頻道網址</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($boothList as $boothItem)
                                    <tr>
                                        <td>{!! HTML::linkRoute('booth.show', $boothItem->name, $boothItem->id, null) !!}</td>
                                        <td>{{ $boothItem->voteCount() }}</td>
                                        <td>{!! HTML::link($boothItem->url, $boothItem->url, ["target" => "_blank"]) !!}</td>
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
