@extends('app')

@section('content')
    <div id="fullpage">
        {{-- Welcome section--}}
        <div class="section" id="section1">

        </div>
        {{-- About section--}}
        <div class="section" id="section2">
            <div class="col-md-6 col-md-offset-6 section-text">
                <h1>關於我們</h1>

                <blockquote>
                    <p>一點點契機、一點點緣分、一點點專業，因為這些，所以我們存在！</p>
                </blockquote>
                <p>
                    逢甲大學黑客社創立於2014年，原本只是一群喜歡資訊的人，在因緣際會之下成立了這個社團。
                </p>
                <p>
                    我們致力推廣<strong>「資訊安全」</strong>及<strong>「程式設計」</strong>，秉持著<strong>「創新與實作」</strong>的理念，
                    除了推廣資訊安全的基礎概念、程式設計普及化、開源文化，同時也致力於推廣包括電子簽到、電子投票等等，
                    希望可以讓每位社員甚至每位學生都能了解到資安的重要性及體驗到更加便利、有趣的未來！
                </p>

                <div>
                    <a class="btn btn-social-icon btn-facebook" target="_blank" href="https://www.facebook.com/groups/HackerSir" title="Facebook社團<br />逢甲大學黑客社公開板 (Hackers Club, FCU)">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a class="btn btn-social-icon btn-github" target="_blank" href="https://github.com/HackerSir" title="Github組織<br />HackerSir">
                        <i class="fa fa-github"></i>
                    </a>
                    <br /><br />
                    <div class="g-ytsubscribe" data-channelid="UCeDnuTpnq_4As-ceZiWsi4A" data-layout="full" data-count="default"></div>
                </div>

            </div>
        </div>
        {{-- Class section--}}
        <div class="section text-right" id="section3">
            <div class="col-md-6 section-text">
                <h1>社團課程</h1>

                <p>
                    本學期(103下)開設<strong>程式設計</strong>課程<br />
                    歡迎有興趣的人來聽課！(歡迎初學者！)<br />
                    每堂社課皆是 07:00 PM 至 09:00 PM！
                </p>
                <table class="tg table table-striped noMoreTable" id="classList">
                    <caption style="color: #000000">課程名稱：<span class="label label-success">請問您今天要來點Python嗎？</span></caption>
                    <thead>
                    <tr class="active">
                        <th>日期</th>
                        <th>地點</th>
                        <th>課程名稱</th>
                        <th>講師</th>
                        <th>狀態</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courseArray as $course)
                        <tr class="@if($course['time'] < $nextCourseTime) success @elseif($course['time'] > $nextCourseTime) info @else warning @endif classData">
                            <td>{{ (new Carbon\Carbon($course['time']))->formatLocalized('%m/%d (%a)') }}</td>
                            <td>{{ $course['location'] }}</td>
                            <td><span class="tg-left">{{ $course['subject'] }}<br />&gt;&gt;&gt;{{ $course['description'] }}</span></td>
                            <td>{{ $course['lecturer'] }}</td>
                            <td>
                                @if($course['time'] < $nextCourseTime)
                                    Finished
                                @elseif($course['time'] > $nextCourseTime)
                                    Coming Soon
                                @else
                                    Next
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ URL::route('course.index') }}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-th-list" aria-hidden="true" />&nbsp;更多課程</a>
            </div>
        </div>
        {{-- Activity section--}}
        <div class="section" id="section4">
            <div class="col-md-6 col-md-offset-6 section-text">
                <h1>社團活動</h1>

                <p>本社每個月和SITCON學生計算機年會合辦一次台中定期聚，下次定期聚時間及資訊如下：</p>
                <ul>
                    <li>104年4月25日 (六)</li>
                    <li>18:00 - 21:00</li>
                    <li>逢甲大學 (未定)</li>
                </ul>
                <p>另外，本社也會不定期舉辦社內或跨社活動，所有活動資訊都會公告在本社臉書社團，敬請關注。</p>
            </div>
        </div>
    </div>
@endsection

@section('css')
    body {
        padding-top: 0px;
    }

    .section {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
    }

    .section-text {
        background: rgba(255,255,255,0.75);
        height: 100%;
        color: black;
        font-size: 15pt;
    }

    #section1 {
        background-size: contain;
        background-image: url({{ URL::asset('pic/Header.jpg') }});
    }
    #section2 {
        background-image: url({{ URL::asset('pic/About.jpg') }});
    }
    #section3 {
        background-image: url({{ URL::asset('pic/Class.jpg') }});
    }
    #section4 {
        background-image: url({{ URL::asset('pic/Activity.jpg') }});
    }

    .tg {
        text-align:center;
        font-size: 13pt;
    }
    .tg td {
        text-align:center
    }
    .tg th {
        text-align:center
    }
    span.tg-left {
        display: block;
        text-align:left
    }

    {{-- 當表格太窄時，會切換顯示模式，改成兩行，左邊是標題，右邊是內容 --}}
    @media
    only screen and (max-width: 479px) {

        /* Force table to not be like tables anymore */
        .noMoreTable table, thead, tbody, th, td, tr.classData {
            display: block;
        }

        /* Hide table headers */
        .noMoreTable thead tr.classData {
            display: none;
        }

        .noMoreTable tr.classData { border: 1px solid #ccc; }

        .noMoreTable tr:not(.classData) {
            display: none;
        }

        .noMoreTable td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 40% !important;
            white-space: normal;
            text-align:left;
        }

        .noMoreTable td:before {
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 6px;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            text-align:left;
        }

        /*
        Label the data
        */
        .noMoreTable td:nth-of-type(1):before { content: "日期"; }
        .noMoreTable td:nth-of-type(2):before { content: "地點"; }
        .noMoreTable td:nth-of-type(3):before { content: "課程名稱"; }
        .noMoreTable td:nth-of-type(4):before { content: "講師"; }
        .noMoreTable td:nth-of-type(5):before { content: "狀態"; }
    }
@endsection

@section('script')
    {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.5.9/jquery.fullPage.min.js'); !!}
    {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.5.9/vendors/jquery.easings.min.js'); !!}
    {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.5.9/vendors/jquery.slimscroll.min.js'); !!}
    {!! HTML::script('https://apis.google.com/js/platform.js'); !!}
@endsection

@section('javascript')
    $(document).ready(function() {
        $('#fullpage').fullpage({
            {{-- Extra small devices (xs) is < 768px --}}
            paddingTop: ($( window ).width() >= 768) ? '50px' : '0px',
            scrollOverflow: ($( window ).width() >= 768),
            scrollBar: true,
            responsive: 768,
            {{-- sectionsColor: ['black', '#4BBFC3', '#7BAABE', '#ccddff'], --}}
            anchors: ['welcome', 'about', 'class', 'activity']
        });
    });
    $(document).ready(function () {
        {{-- //TODO:: 隱藏顯示不下的課程，暫時從前台下手，
                    未來應該改成從後台下手，固定顯示數量，
                    前台在動態固定表格高度，可能在加一層div
                    這樣在空間不足時，還有個卷軸可用
                    雖然應該會很難操作。--}}
        {{-- 限制課程清單只有 section3 高度的 50% --}}
        var html_hide_tr = '<tr class="info"><td colspan="5"><span class="glyphicon glyphicon-option-vertical" aria-hidden="true" /></td></tr>';
        var targetTableHeight = ($( window ).width() >= 768) ? $( window ).height() * 0.5 : $( window ).height() * 1.5;
        if ($('#classList').height() > targetTableHeight) {
            var trList = $('#classList tbody tr');
            var hasNone = false;
            for (var i = 0; i < trList.length; i++) {
                {{-- jQuery 怪怪的，不能用 hasClass ... --}}
                {{-- //TODO:: 未來可能會有 Bug --}}
                if (trList[i].className.indexOf('success') != -1) {
                    trList[i].style.display = 'none';
                    hasNone = true;
                    if ($('#classList').height() <= targetTableHeight) break;
                }
            }
            if (hasNone) {
                $('#classList tbody').prepend(html_hide_tr);
            }
        }

        if ($('#classList').height() > targetTableHeight) {
            var trList = $('#classList tbody tr');
            var hasNone = false;
            for (var i = trList.length - 1; i >= 0 ; i--) {
                if (trList[i].className.indexOf('info') != -1) {
                    trList[i].style.display = 'none';
                    hasNone = true;
                    if ($('#classList').height() <= targetTableHeight) break;
                }
            }
            if (hasNone) {
                $('#classList tbody').append(html_hide_tr);
            }
        }
    });
@endsection
