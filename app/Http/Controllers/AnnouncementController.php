<?php namespace App\Http\Controllers;

use App\Announcement;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
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
        $announcementList = Announcement::orderBy('id', 'desc')->paginate(20);
        return view('announcement.list')->with('announcementList', $announcementList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('announcement.create');
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
                'title' => 'required|max:100',
                'start_time' => 'date',
                'end_time' => 'date',
                'message' => 'required|max:65535'
            )
        );

        if ($validator->fails()) {
            return Redirect::route('announcement.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            //檢查時間
            $start_time = ($request->has('start_time')) ? $request->get('start_time') : null;
            $end_time = ($request->has('end_time')) ? $request->get('end_time') : null;
            if ($end_time != null) {
                if ($start_time == null) {
                    $end_time = null;
                } else {
                    if ((new Carbon($start_time))->gte(new Carbon($end_time))) {
                        $end_time = null;
                    }
                }
            }

            $announcement = Announcement::create(array(
                'title' => $request->get('title'),
                'start_time' => $start_time,
                'end_time' => $end_time,
                'message' => $request->get('message'),
            ));

            return Redirect::route('announcement.show', $announcement->id)
                ->with('global', '公告已建立');
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
        $announcement = Announcement::find($id);
        if ($announcement) {
            return view('announcement.show')->with('announcement', $announcement);
        }
        return Redirect::route('announcement.index')
            ->with('warning', '公告不存在');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $announcement = Announcement::find($id);
        if ($announcement) {
            return view('announcement.edit')->with('announcement', $announcement);
        }
        return Redirect::route('announcement.index')
            ->with('warning', '公告不存在');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $announcement = Announcement::find($id);
        if (!$announcement) {
            return Redirect::route('announcement.index')
                ->with('warning', '公告不存在');
        }

        $validator = Validator::make($request->all(),
            array(
                'title' => 'required|max:100',
                'start_time' => 'date',
                'end_time' => 'date',
                'message' => 'required|max:65535'
            )
        );

        if ($validator->fails()) {
            return Redirect::route('announcement.edit', $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            //檢查時間
            $start_time = ($request->has('start_time')) ? $request->get('start_time') : null;
            $end_time = ($request->has('end_time')) ? $request->get('end_time') : null;
            if ($end_time != null) {
                if ($start_time == null) {
                    $end_time = null;
                } else {
                    if ((new Carbon($start_time))->gte(new Carbon($end_time))) {
                        $end_time = null;
                    }
                }
            }
            $announcement->title = $request->get('title');
            $announcement->start_time = $start_time;
            $announcement->end_time = $end_time;
            $announcement->message = $request->get('message');
            $announcement->save();

            return Redirect::route('announcement.show', $id)
                ->with('global', '公告已更新');
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
        $announcement = Announcement::find($id);
        if (!$announcement) {
            return Redirect::route('announcement.index')
                ->with('warning', '公告不存在');
        }
        //移除公告
        $announcement->delete();
        return Redirect::route('announcement.index')
                ->with('global', '公告已刪除');
    }

}
