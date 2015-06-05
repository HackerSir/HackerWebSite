<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\VoteBallot;
use App\VoteEvent;
use App\VoteUser;
use Carbon\Carbon;
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
        if (!$voteEvent->isStarted() || $voteEvent->isEnded()) {
            return Redirect::route('vote-event.index')
                ->with('warning', '非投票時間');
        }
        $action = Session::get('action');
        if (empty($action)) {
            return view('vote.vote')->with('voteEvent', $voteEvent);
        } else if ($action == 'user-vote') {
            $selectionList = [null => "-- 請下拉選擇 --"];
            $selections = $voteEvent->voteSelections;
            foreach ($selections as $selection) {
                $selectionList[$selection->id] = $selection->getText();
            }
            return view('vote.vote-select')->with('voteEvent', $voteEvent)->with('selectionList', $selectionList);
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
        if (!$voteEvent->isStarted() || $voteEvent->isEnded()) {
            return Redirect::route('vote-event.index')
                ->with('warning', '非投票時間');
        }

        if ($action == 'send_nid') {
            $nid = Input::get('nid');
            if (!empty($nid)) {
                $voteUser = VoteUser::whereHas('card', function ($q) use ($nid) {
                    $q->where('nid', '=', $nid);
                })->where('vote_event_id', '=', $vid)->where('voted', '=', 0)->first();
                if ($voteUser) {
                    Session::put('nid', $nid);
                    Session::put('action', 'user-vote');
                    return Redirect::route('vote.vote', ['id' => $vid]);
                }
            }
            return Redirect::route('vote.vote', ['id' => $vid])
                ->with('warning', '該NID不存在、尚未簽到或已投票，請洽監票人員。')
                ->withInput();
        } else if ($action == 'vote-selected') {
            $nid = Session::get('nid');
            $selection = Input::get('vote-select');
            if (!empty($selection)) {
                // Set User Voted
                $voteUser = VoteUser::whereHas('card', function ($q) use ($nid) {
                    $q->where('nid', '=', $nid);
                })->where('vote_event_id', '=', $vid)->where('voted', '=', 0)->first();
                if ($voteUser == null) {
                    return Redirect::route('vote.vote', ['id' => $vid])
                        ->with('warning', '該NID不存在、尚未簽到或已投票，請洽監票人員。')
                        ->withInput();
                }
                $voteUser->voted = 1;
                $voteUser->save();

                do {
                    $voteBallot = null;
                    try {
                        //嘗試建立投票資料
                        $voteBallot = VoteBallot::create(array(
                            'id' => str_random(64),
                            'vote_event_id' => $vid,
                            'vote_selection_id' => $selection,
                        ));
                    } catch (\Exception $e) {

                    }
                    //若失敗（碰撞）則持續嘗試
                } while ($voteBallot == null);

                Session::forget('action');
                return Redirect::route('vote.vote', ['id' => $vid])
                    ->with('global', '投票完成');
            }
        } else if ($action == 'reset') {
            Session::forget('nid');
            Session::forget('action');
            return Redirect::route('vote.vote', ['id' => $vid])
                ->with('global', '投票狀態已重設');
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
