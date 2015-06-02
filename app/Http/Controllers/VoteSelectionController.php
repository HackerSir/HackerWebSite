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
use Illuminate\Support\Facades\Validator;

class VoteSelectionController extends Controller
{

    public function __construct()
    {
        //限工作人員
        $this->middleware('staff');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
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
        return view('vote.selection.list')->with('voteEvent', $voteEvent);
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

        $validator = Validator::make($request->all(),
            array(
                'alt_text' => 'max:100'
            )
        );
        $validator->sometimes('alt_text', 'required|max:100', function ($input) {
            return empty($input->nid);
        });

        if ($validator->fails()) {
            return Redirect::route('vote-selection.create', ['vid' => $voteEvent->id])
                ->withErrors($validator)
                ->withInput();
        } else {
            if ($request->has('nid')) {
                $card = Card::where('nid', '=', $request->get('nid'))->first();
                if ($card == null) {
                    return Redirect::route('vote-selection.create', ['vid' => $voteEvent->id])
                        ->with('warning', '該NID沒有卡片資料');
                }
            }

            $voteSelection = VoteSelection::create(array(
                'vote_event_id' => $voteEvent->id,
                'card_id' => (isset($card) && $card != null) ? $card->id : null,
                'alt_text' => $request->get('alt_text')
            ));

            return Redirect::route('vote-selection.index', ['vid' => $voteEvent->id])
                ->with('global', '投票選項已建立');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return "show($id)";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        return "edit($id)";
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
        return "update($id)";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        return "destroy($id)";
    }

}
