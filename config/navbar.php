<?php

use Illuminate\Support\Facades\Auth;

return array(

    /**
     * 巡覽列
     *
     * 基本格式：'連結名稱' => '連結路由'
     *
     * 多層：最多支援兩層，二級選單以下拉式選單呈現
     */

    //基本巡覽列
    'navbar' => array(
        '關於我們' => 'about',
        '社團課程' => 'class',
        '社團活動' => 'activity',
    ),

    //會員
    'member' => array(
        '%user%' => array(
            '登出' => 'member/logout'
        )
    ),

    //遊客
    'guest' => array(
        '登入' => 'member/login'
    ),
);
