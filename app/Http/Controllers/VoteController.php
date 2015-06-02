<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class VoteController extends Controller
{
    //投票頁面
    public function getIndex()
    {
        $vid = Request::get('id');
        $voteEvent = VoteEvent::find($vid);
        if ($voteEvent !=NULL){
            $action = Session::get('action');
            if ($action == NULL){
                return view('vote.vote')->with('voteEvent', $voteEvent);
            }
            else if ($action == 'user-vote'){
                return view('vote.vote-select')->with('voteEvent', $voteEvent);
            }
            else{
                return view('vote.vote')->with('warning', '未預期的行為，請洽網站管理人員！');
            }
        }
        return Redirect::route('vote-event.index');
    }

    //投票頁面
    public function postIndex(){
        $action = Request::get('action');
        // FIXME
        $vid = 1;
        if ($action == 'send_nid'){
            $nid = Request::get('nid');
            if (!empty($nid)){
                $voteUser = VoteUser::where('nid', '=', $nid)->where('vote_event_id', '=', $vid)->first();
                if ($voteUser != NULL){
                    Session::put('nid', $nid);
                    Session::put('action', 'user-vote');
                    return Redirect::route('vote.vote');
                }

            }
            return Redirect::route('vote.vote')->with('warning', '查無NID或NID尚未簽到, 請洽監票人員。');
        }
        else if ( $action == 'vote-selected'){
            $nid = Request::get('nid');
            $selection = Request::get('vote-select');
            if (!empty($selection)){
                $voteEvent = VoteEvent::find($vid);
                if ($voteEvent->isStarted() && !$voteEvent->isEnded()){
                    // Set User Voted
                    $voteUser = VoteUser::where('nid', '=', $nid)->where('vote_event_id', '=', $vid)->first();
                    $voteUser->voted = 1;
                    $voteUser->save();
                    // Create Ticket
                    $voteBallot = VoteBallot::create(array(
                        'vote_event_id' => $vid,
                        'vote_selection_id' => $selection,
                    ));
                    $voteBallot->generateHash($nid);
                    $voteBallot->save();
                    Session::forget('action');
                }
            }
        }
        return Redirect::route('vote.vote')->with('warning', '未預期的錯誤，請找網站管理員喝茶！');
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
