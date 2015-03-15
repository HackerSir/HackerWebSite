@extends('app')

@section('title')
    {{ $user->nickname }} - 個人資料
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $user->nickname }} - 個人資料</div>
                    {{-- Panel body --}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="text-center">
                                {{-- Gravatar大頭貼 --}}
                                {!! HTML::image($user->gravatar(), null, ['class' => 'img-circle']) !!}
                            </div>
                        </div>
                        <br/>

                        <div class="row">
                            <div class="text-center col-md-10 col-md-offset-1">
                                <table class="table table-hover">
                                    <tr>
                                        <td>真實姓名：</td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>暱稱：</td>
                                        <td>{{ $user->nickname }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email：</td>
                                        <td>
                                            {{ $user->email }}
                                            @if($user->isConfirmed())
                                                <span class="label label-success">已驗證</span>
                                            @else
                                                <a href="{{ URL::route('member.resend') }}"><span class="label label-danger">未驗證</span></a>
                                            @endif
                                        </td>
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
                                    @if($user->isStaff())
                                        <tr>
                                            <td>職務：</td>
                                            <td>{{ $user->job }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>註冊：</td>
                                        <td>{{ $user->register_at }}</td>
                                    </tr>
                                    <tr>
                                        <td>最後登入：</td>
                                        <td>{{ $user->lastlogin_at }}</td>
                                    </tr>
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
