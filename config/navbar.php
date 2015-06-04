<?php

use Illuminate\Support\Facades\Auth;

return array(

    /**
     * 巡覽列
     *
     * 基本格式：'連結名稱' => '連結路由'
     *
     * 多層：二級選單以下拉式選單呈現，更多層級以巢狀顯示，太多層可能會超過螢幕顯示範圍
     * 外部連結：在連結路由部分，直接填上完整網址（開頭需包含協定類型）
     */

    //基本巡覽列
    'navbar' => array(
        '關於我們' => '#about',
        '社團課程' => '#class',
        '社團活動' => '#activity',
        '課程清單' => 'course',
        '學生會選舉' => 'http://hackersir.info/savote',
    ),

    //會員
    'member' => array(
        '成員清單' => 'member',
        '%user%' => array(
            '個人資料' => 'member/profile',
            '修改密碼' => 'member/change-password',
            '登出' => 'member/logout'
        )
    ),

    //學生會
//    'sa' => array(
//        ' ' => array(
//            '候選人' => 'candidate',
//            '投票所' => 'booth'
//        )
//    ),

    //工作人員
    'staff' => array(
        '工作人員' => array(
            '卡片管理' => 'card',
            '記錄檢視器' => 'logs',
            '相關連結' => array(
                'Hackpad' => 'https://hackersir.hackpad.com/',
                'Google Drive' => 'https://drive.google.com/open?id=0B9v9i5Qg6TFgfklzVFQ1V1RscEd5dHN6VEVOUlNNdUNEeTQtTk0yeUxlVXZPOW5ZNlBpbWs&authuser=0'
            ),
            '投票系統' => 'vote-event',
        )
    ),

    //遊客
    'guest' => array(
        '登入' => 'member/login'
    ),
);
