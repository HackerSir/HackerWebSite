@extends('app')

@section('title')
    {{ $showUser->nickname }} - 個人資料
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $showUser->nickname }} - 個人資料</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="text-center">
                                {{-- Gravatar大頭貼 --}}
                                {!! HTML::image($showUser->gravatar(), null, ['class' => 'img-circle']) !!}
                            </div>
                        </div>
                        <br/>

                        <div class="row">
                            <div class="text-center col-md-10 col-md-offset-1">
                                <table class="table table-hover">
                                    <tr>
                                        <td>真實姓名：</td>
                                        <td>{{ $showUser->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>暱稱：</td>
                                        <td>{{ $showUser->nickname }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email：</td>
                                        <td>
                                            {{ $showUser->email }}
                                            @if($showUser->isConfirmed())
                                                <span class="label label-success">已驗證</span>
                                            @else
                                                <a href="{{ URL::route('member.resend') }}"><span class="label label-danger">未驗證</span></a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>系級：</td>
                                        <td>{{ $showUser->grade }}</td>
                                    </tr>
                                    <tr>
                                        <td>用戶組：</td>
                                        <td>{{ $showUser->group->title }}</td>
                                    </tr>
                                    @if($showUser->isStaff())
                                        <tr>
                                            <td>職務：</td>
                                            <td>{{ $showUser->job }}</td>
                                        </tr>
                                    @endif
                                    @if($user->isStaff())
                                        <tr>
                                            <td colspan="2" class="danger">
                                                以下僅工作人員可見
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>NID：</td>
                                            <td>{{ $showUser->nid }}</td>
                                        </tr>
                                        <tr>
                                            <td>註冊時間：</td>
                                            <td>{{ $showUser->register_at }}</td>
                                        </tr>
                                        <tr>
                                            <td>註冊IP：</td>
                                            <td>{{ $showUser->register_ip }}</td>
                                        </tr>
                                        <tr>
                                            <td>最後登入時間：</td>
                                            <td>{{ $showUser->lastlogin_at }}</td>
                                        </tr>
                                        <tr>
                                            <td>最後登入IP：</td>
                                            <td>{{ $showUser->lastlogin_ip }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="2">{!! HTML::linkRoute('member.edit-profile', '編輯個人資料', null, ['class' => 'btn btn-primary']) !!}</td>
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
