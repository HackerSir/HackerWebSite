<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\VoteEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class VoteEventController extends Controller
{

    public function __construct()
    {
        //限工作人員
        $this->middleware('staff', [
            'except' => [
                'index',
                'show'
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $voteEventList = VoteEvent::orderBy('id', 'desc')->paginate(20);
        return view('vote.event.list')->with('voteEventList', $voteEventList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('vote.event.create');
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
                'subject' => 'required|max:100',
                'location' => 'max:20',
                'open_time' => 'date',
                'close_time' => 'date',
                'watcher' => 'integer',
                'info' => 'max:65535'
            )
        );

        if ($validator->fails()) {
            return Redirect::route('vote-event.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            if ($request->has('watcher')) {
                $watcher = User::find($request->get('watcher'))->first();
            }
            if (!isset($watcher) || $watcher == null) {
                $watcher = Auth::user();
            }
            //檢查時間
            $open_time = ($request->has('open_time')) ? $request->get('open_time') : null;
            $close_time = ($request->has('close_time')) ? $request->get('close_time') : null;
            if ($close_time != null) {
                if ($open_time == null) {
                    $close_time = null;
                } else {
                    if ((new Carbon($open_time))->gte(new Carbon($close_time))) {
                        $close_time = null;
                    }
                }
            }

            $voteEvent = VoteEvent::create(array(
                'subject' => $request->get('subject'),
                'location' => $request->get('location'),
                'open_time' => $open_time,
                'close_time' => $close_time,
                'creator' => Auth::user()->id,
                'watcher' => $watcher->id,
                'info' => $request->get('info'),
            ));

            return Redirect::route('vote-event.show', $voteEvent->id)
                ->with('global', '投票活動已建立');
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
        $user = Auth::user();
        $voteEvent = VoteEvent::find($id);
        if ($voteEvent) {
            return view('vote.event.show')->with('user', $user)->with('voteEvent', $voteEvent);
        }
        return Redirect::route('vote-event.index')
            ->with('warning', '投票活動不存在');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $voteEvent = VoteEvent::find($id);
        if ($voteEvent) {
            return view('vote.event.edit')->with('voteEvent', $voteEvent);
        }
        return Redirect::route('vote-event.index')
            ->with('warning', '投票活動不存在');
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
        $voteEvent = VoteEvent::find($id);
        if (!$voteEvent) {
            return Redirect::route('vote-event.index')
                ->with('warning', '投票活動不存在');
        }

        $validator = Validator::make($request->all(),
            array(
                'subject' => 'required|max:100',
                'location' => 'max:20',
                'open_time' => 'date',
                'close_time' => 'date',
                'watcher' => 'integer',
                'info' => 'max:65535'
            )
        );

        if ($validator->fails()) {
            return Redirect::route('vote-event.edit', $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            if ($request->has('watcher')) {
                $watcher = User::find($request->get('watcher'))->first();
            }
            if (!isset($watcher) || $watcher == null) {
                $watcher = Auth::user();
            }
            //檢查時間
            $open_time = ($request->has('open_time')) ? $request->get('open_time') : null;
            $close_time = ($request->has('close_time')) ? $request->get('close_time') : null;
            if ($close_time != null) {
                if ($open_time == null) {
                    $close_time = null;
                } else {
                    if ((new Carbon($open_time))->gte(new Carbon($close_time))) {
                        $close_time = null;
                    }
                }
            }
            $voteEvent->subject = $request->get('subject');
            $voteEvent->location = $request->get('location');
            $voteEvent->open_time = $open_time;
            $voteEvent->close_time = $close_time;
            $voteEvent->watcher = $watcher->id;
            $voteEvent->info = $request->get('info');
            $voteEvent->save();

            return Redirect::route('vote-event.show', $id)
                ->with('global', '投票活動已更新');
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
        $voteEvent = VoteEvent::find($id);
        //移除課程
        $voteEvent->delete();
        return Redirect::route('vote-event.index')
            ->with('global', '投票活動已刪除');
    }

}
