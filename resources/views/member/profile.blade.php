@extends('app')

@section('title')
    {{ $user->name }} - 個人資料
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $user->name }} - 個人資料</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="text-center">
                                {{-- Gravatar大頭貼 --}}
                                {!! HTML::image($user->gravatar(), null, ['class' => 'img-circle']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-center col-md-10 col-md-offset-1">
                                <table class="table table-hover">
                                    <tr>
                                        <td>暱稱：</td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email：</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>NID：</td>
                                        <td>{{ $user->nid }}</td>
                                    </tr>
                                    <tr>
                                        <td>系級：</td>
                                        <td>{{ $user->grade }}</td>
                                    </tr>
                                    <tr>
                                        <td>用戶組：</td>
                                        <td>{{ $user->group->title }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
