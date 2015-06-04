<?php namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EntranceController extends Controller
{


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
    public function index()
    {
        //FIXME 之後改由公告系統抓取
        $beginTime = Carbon::create(2015, 6, 4, 0, 0, 0);
        $endTime = Carbon::create(2015, 6, 9, 23, 59, 59);

        //若是公告有效期間
        if (Carbon::now()->between($beginTime, $endTime)) {
            //未曾觀看公告或觀看公告時間再開始時間之前（看的是前一個公告）
            if (!Session::has('visitEnterPage') || Carbon::createFromTimestamp(Session::get('visitEnterPage'))->diffInSeconds($beginTime) < 0) {
                return Redirect::route('enter-page');
            }
        }
        return Redirect::route('home');
    }
}
