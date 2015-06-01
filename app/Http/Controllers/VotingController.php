<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class VotingController extends Controller
{
    //投票頁面
    public function getVote($id, Request $request)
    {
        return 'getVote($id, Request $request)';
    }

    //開票頁面
    public function getBilling($id)
    {
        return 'getBilling($id)';
    }

    //開始投票
    public function postStart($id)
    {
        return 'postStart($id)';
    }

    //結束投票
    public function postEnd($id)
    {
        return 'postEnd($id)';
    }

}
