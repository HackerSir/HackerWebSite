<?php namespace App\Http\Controllers;

use App\Announcement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EnterPageController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index($id = null)
    {
        if (empty($id)) {
            //取得公告（開始時間為之前，結束時間為之後或空值）
            $announcement = Announcement::where('start_time', '<', Carbon::now()->toDateTimeString())
                ->where(function ($query) {
                    $query->where('end_time', '>', Carbon::now()->toDateTimeString())
                        ->orWhereNull('end_time');
                })->orderBy('start_time', 'desc')->first();
            if ($announcement) {
                //記錄最後觀看公告ID和時間
                Session::put('lastVisitAnnouID', $announcement->id);
                Session::put('lastVisitAnnouTime', Carbon::now()->timestamp);
            }
        } else {
            //取得指定ID之公告
            $announcement = Announcement::find($id);
        }
        if (!$announcement) {
            return Redirect::route('announcement.index')
                ->with('warning', '公告不存在');
        }
        return view('entrance')->with('announcement', $announcement);

    }

}
