<?php namespace App\Http\Controllers;

use App\Card;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\VoteEvent;
use App\VoteUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class VoteUserController extends Controller
{
    public function __construct()
    {
        //限工作人員
        $this->middleware('staff');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            array(
                'nid' => 'required|max:100',
                'event_id' => 'required|integer'
            )
        );

        $vid = $request->get('event_id');
        $voteEvent = VoteEvent::find($vid);
        if (!$voteEvent) {
            return Redirect::route('vote-event.index')
                ->with('warning', '投票活動不存在');
        }
        if (!$voteEvent->isInProgress()) {
            return Redirect::route('vote-event.show', ['vid' => $voteEvent->id])
                ->with('warning', '投票活動並非進行中');
        }

        if ($validator->fails()) {
            return Redirect::route('vote-event.show', ['vid' => $voteEvent->id])
                ->withErrors($validator)
                ->withInput();
        } else {
            //檢查NID是否有卡片資料
            $card = Card::where('nid', '=', $request->get('nid'))->first();
            if ($card == null) {
                return Redirect::route('vote-event.show', ['vid' => $voteEvent->id])
                    ->with('warning', '該NID沒有卡片資料')
                    ->withInput();
            }
            //檢查是否簽到過
            $voteUserCount = VoteUser::where('vote_event_id', '=', $vid)->where('card_id', '=', $card->id)->count();
            if ($voteUserCount > 0) {
                return Redirect::route('vote-event.show', ['vid' => $voteEvent->id])
                    ->with('warning', '已簽到者無法重複簽到')
                    ->withInput();
            }
            //建立簽到資料
            $voteUser = VoteUser::create(array(
                'card_id' => $card->id,
                'vote_event_id' => $voteEvent->id,
                'check_in_time' => Carbon::now()->toDateTimeString()
            ));

            return Redirect::route('vote-event.show', $voteEvent->id)
                ->with('global', '已新增簽到資料');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $voteUser = VoteUser::find($id);
        if ($voteUser == null) {
            return Redirect::route('vote-event.index')
                ->with('global', '簽到記錄不存在');
        }
        $voteEvent = $voteUser->voteEvent;
        if (!$voteEvent->isInProgress()) {
            return Redirect::route('vote-event.show', ['vid' => $voteEvent->id])
                ->with('warning', '投票活動並非進行中');
        }
        if ($voteUser->isVoted()) {
            return Redirect::route('vote-event.show', ['vid' => $voteEvent->id])
                ->with('warning', '該簽到者已完成投票，無法刪除簽到記錄');
        }
        //移除投票選項
        $voteUser->delete();
        return Redirect::route('vote-event.show', $voteEvent->id)
            ->with('global', '簽到記錄已刪除');
    }

}
