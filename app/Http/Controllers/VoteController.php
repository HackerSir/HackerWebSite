<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\VoteBallot;
use App\VoteEvent;
use App\VoteUser;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class VoteController extends Controller
{
    //投票頁面
    public function getIndex()
    {
        $vid = Input::get('id');
        if (empty($vid) || !is_numeric($vid)) {
            return Redirect::route('vote-event.index')
                ->with('warning', '請選擇投票活動');
        }
        $voteEvent = VoteEvent::find($vid);
        if ($voteEvent == null) {
            return Redirect::route('vote-event.index')
                ->with('warning', '投票活動不存在');
        }
        $action = Session::get('action');
        if ($action == NULL) {
            return view('vote.vote')->with('voteEvent', $voteEvent);
        } else if ($action == 'user-vote') {
            return view('vote.vote-select')->with('voteEvent', $voteEvent);
        }
        return view('vote.vote')->with('warning', '未預期的行為，請洽網站管理人員！');
    }

    //投票頁面
    public function postIndex()
    {
        $action = Input::get('action');
        $vid = Input::get('vid');
        if (empty($vid) || !is_numeric($vid)) {
            return Redirect::route('vote-event.index')
                ->with('warning', '請選擇投票活動');
        }
        $voteEvent = VoteEvent::find($vid);
        if ($voteEvent == null) {
            return Redirect::route('vote-event.index')
                ->with('warning', '投票活動不存在');
        }

        if ($action == 'send_nid') {
            $nid = Input::get('nid');
            if (!empty($nid)) {
                $voteUser = VoteUser::whereHas('card', function ($q) use ($nid) {
                    $q->where('nid', '=', $nid);
                })->where('vote_event_id', '=', $vid)->first();
                if ($voteUser) {
                    Session::put('nid', $nid);
                    Session::put('action', 'user-vote');
                    return Redirect::route('vote.vote', ['id' => $vid]);
                }
            }
            return Redirect::route('vote.vote', ['id' => $vid])
                ->with('warning', '查無NID或NID尚未簽到, 請洽監票人員。')
                ->withInput();
        } else if ($action == 'vote-selected') {
            $nid = Input::get('nid');
            $selection = Input::get('vote-select');
            if (!empty($selection)) {
                $voteEvent = VoteEvent::find($vid);
                if ($voteEvent->isStarted() && !$voteEvent->isEnded()) {
                    // Set User Voted
                    $voteUser = VoteUser::whereHas('card', function ($q) use ($nid) {
                        $q->where('nid', '=', $nid);
                    })->where('vote_event_id', '=', $vid)->first();
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
        return Redirect::route('vote.vote', ['id' => $vid])->with('warning', '未預期的錯誤，請找網站管理員喝茶！');
    }

    //開票頁面
    public function getBilling()
    {
        return 'getBilling()';
    }

    // 暫存: 學生會
    public function saVote()
    {
        return File::get('savote/index.html');
    }

}
