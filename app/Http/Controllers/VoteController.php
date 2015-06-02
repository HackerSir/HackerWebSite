<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class VoteController extends Controller
{
    //投票頁面
    public function getIndex()
    {
        return 'getIndex()';
    }

    //開票頁面
    public function getBilling()
    {
        return 'getBilling()';
    }

    //開始投票
    public function postStart()
    {
        return 'postStart()';
    }

    //結束投票
    public function postEnd()
    {
        return 'postEnd()';
    }

    // 暫存: 學生會
    public function saVote(){
        return File::get('savote/index.html');
    }

}
