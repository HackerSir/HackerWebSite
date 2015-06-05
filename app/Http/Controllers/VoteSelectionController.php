<?php namespace App\Http\Controllers;

use App\Card;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\VoteEvent;
use App\VoteSelection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class VoteSelectionController extends Controller
{

    public function __construct()
    {
        //限工作人員
        $this->middleware('staff');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
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
        if ($voteEvent->isStarted()) {
            return Redirect::route('vote-event.show', $voteEvent->id)
                ->with('warning', '只能在投票活動開始前編輯選項');
        }
        return view('vote.selection.create')->with('voteEvent', $voteEvent);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $vid = $request->get('vid');
        if (empty($vid) || !is_numeric($vid)) {
            return Redirect::route('vote-event.index')
                ->with('warning', '請選擇投票活動');
        }
        $voteEvent = VoteEvent::find($vid);
        if ($voteEvent == null) {
            return Redirect::route('vote-event.index')
                ->with('warning', '投票活動不存在');
        }
        if ($voteEvent->isStarted()) {
            return Redirect::route('vote-event.show', $voteEvent->id)
                ->with('warning', '只能在投票活動開始前編輯選項');
        }

        $validator = Validator::make($request->all(),
            array(
                'alt_text' => 'required_without:nid|max:100'
            )
        );

        if ($validator->fails()) {
            return Redirect::route('vote-selection.create', ['vid' => $voteEvent->id])
                ->withErrors($validator)
                ->withInput();
        } else {
            //檢查NID是否有卡片資料
            if ($request->has('nid')) {
                $card = Card::where('nid', '=', $request->get('nid'))->first();
                if ($card == null) {
                    return Redirect::route('vote-selection.create', ['vid' => $voteEvent->id])
                        ->with('warning', '該NID沒有卡片資料')
                        ->withInput();
                }
                //檢查該卡片是否已是其他選項
                $cardCount = VoteSelection::where('vote_event_id', '=', $vid)->where('card_id', '=', $card->id)->count();
                if ($cardCount > 0) {
                    return Redirect::route('vote-selection.create', ['vid' => $voteEvent->id])
                        ->with('warning', '該NID已是選項之一')
                        ->withInput();
                }
            }

            $voteSelection = VoteSelection::create(array(
                'vote_event_id' => $voteEvent->id,
                'card_id' => (isset($card) && $card != null) ? $card->id : null,
                'alt_text' => $request->get('alt_text')
            ));

            return Redirect::route('vote-event.show', $voteSelection->voteEvent->id)
                ->with('global', '投票選項已建立');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $voteSelection = VoteSelection::find($id);
        if (!$voteSelection) {
            return Redirect::route('vote-event.index')
                ->with('warning', '投票選項不存在');
        }
        if ($voteSelection->voteEvent->isStarted()) {
            return Redirect::route('vote-event.show', $voteSelection->voteEvent->id)
                ->with('warning', '只能在投票活動開始前編輯選項');
        }
        return view('vote.selection.edit')->with('voteSelection', $voteSelection);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $voteSelection = VoteSelection::find($id);
        if (!$voteSelection) {
            return Redirect::route('vote-event.index')
                ->with('warning', '投票選項不存在');
        }
        if ($voteSelection->voteEvent->isStarted()) {
            return Redirect::route('vote-event.show', $voteSelection->voteEvent->id)
                ->with('warning', '只能在投票活動開始前編輯選項');
        }

        $validator = Validator::make($request->all(),
            array(
                'alt_text' => 'required_without:nid|max:100'
            )
        );

        if ($validator->fails()) {
            return Redirect::route('vote-selection.edit', $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            //檢查NID是否有卡片資料
            if ($request->has('nid')) {
                $card = Card::where('nid', '=', $request->get('nid'))->first();
                if ($card == null) {
                    return Redirect::route('vote-selection.edit', $voteSelection->id)
                        ->with('warning', '該NID沒有卡片資料')
                        ->withInput();
                }
                //檢查該卡片是否已是其他選項
                $cardCount = VoteSelection::where('vote_event_id', '=', $voteSelection->voteEvent->id)->where('card_id', '=', $card->id)->where('id', '<>', $voteSelection->id)->count();
                if ($cardCount > 0) {
                    return Redirect::route('vote-selection.edit', $voteSelection->id)
                        ->with('warning', '該NID已是選項之一')
                        ->withInput();
                }
            }

            $voteSelection->card_id = (isset($card) && $card != null) ? $card->id : null;
            $voteSelection->alt_text = $request->get('alt_text');
            $voteSelection->save();

            return Redirect::route('vote-event.show', $voteSelection->voteEvent->id)
                ->with('global', '投票選項已更新');
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
        $voteSelection = VoteSelection::find($id);
        if (!$voteSelection) {
            return Redirect::route('vote-event.index')
                ->with('warning', '投票選項不存在');
        }
        if ($voteSelection->voteEvent->isStarted()) {
            return Redirect::route('vote-event.show', $voteSelection->voteEvent->id)
                ->with('warning', '只能在投票活動開始前編輯選項');
        }
        $voteEvent = $voteSelection->voteEvent;
        //移除投票選項
        $voteSelection->delete();
        return Redirect::route('vote-event.show', $voteEvent->id)
            ->with('global', '投票選項已刪除');
    }

}
