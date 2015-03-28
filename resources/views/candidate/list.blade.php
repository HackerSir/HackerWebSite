@extends('app')

@section('title')
    候選人清單
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">候選人清單</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        {!! HTML::linkRoute('candidate.create', '新增候選人', [], ['class' => 'btn btn-primary pull-right']) !!}
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="col-md-1">號碼</th>
                                    <th class="col-md-2">職稱</th>
                                    <th class="col-md-3">姓名</th>
                                    <th class="col-md-2">系所</th>
                                    <th class="col-md-2">班級</th>
                                    <th class="col-md-2">投票類型</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($candidateList as $candidateItem)
                                    <tr>
                                        <td>{{ $candidateItem->number }}</td>
                                        <td>{{ $candidateItem->job }}</td>
                                        <td>{!! HTML::linkRoute('candidate.show', $candidateItem->name, $candidateItem->id, null) !!}</td>
                                        <td>{{ $candidateItem->department }}</td>
                                        <td>{{ $candidateItem->class }}</td>
                                        <td>{{ $candidateItem->type }}</td>
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
