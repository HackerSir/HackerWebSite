<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>{{ Config::get('config.sitename') }}</h2>

        <div>
            歡迎加入 {{ Config::get('config.sitename') }} ，<br/>
            請透過以下連結，完成帳號驗證：<br/>
            ---<br/>
            <a href="{{ $link }}">{{ $link }}</a><br/>
            ---<br/>
        </div>
    </body>
</html>
