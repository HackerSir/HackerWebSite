<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class VotingController extends Controller
{
    //投票頁面
    public function vote($id, Request $request)
    {
        return 'vote($id, Request $request)';
    }

    //開票頁面
    public function billing($id)
    {
        return 'billing($id)';
    }

}
