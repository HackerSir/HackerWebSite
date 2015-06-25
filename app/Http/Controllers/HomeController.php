<?php namespace App\Http\Controllers;

use App\Announcement;
use App\Course;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
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
     * @return Response
     */
    public function index()
    {
        //取得公告（開始時間為之前，結束時間為之後或空值）
        $announcement = Announcement::where('start_time', '<', Carbon::now()->toDateTimeString())
            ->where(function ($query) {
                $query->where('end_time', '>', Carbon::now()->toDateTimeString())
                    ->orWhereNull('end_time');
            })->orderBy('start_time', 'desc')->first();

        if ($announcement) {
            $startTime = new Carbon($announcement->start_time);
            //未曾觀看此公告，或觀看時間在開始時間之前（公告可能修改或重發過）
            //dd(Session::get('lastVisitAnnouTime'));
            if (!Session::has('lastVisitAnnouTime') || Carbon::createFromTimestamp(Session::get('lastVisitAnnouTime'))->diffInSeconds($startTime) < 0
                || !Session::has('lastVisitAnnouID') || Session::get('lastVisitAnnouID') != $announcement->id
            ) {
                return Redirect::route('enter-page');
            }
        }
        return $this->home();
    }

    public function home()
    {
        //計算課程數量
        $courseCount = Course::count();
        //課程清單
        $courseArray = [];
        //建立Collection
        $courseList = new Collection();
        //下次時間
        $nextCourseTime = Carbon::now();
        if ($courseCount > 0) {
            //計算前後課程數量
            $prevCourseCount = Course::where('time', '<', Carbon::now()->toDateTimeString())->count();
            $nextCourseCount = Course::where('time', '>=', Carbon::now()->toDateTimeString())->count();

            if ($courseCount <= 10 || $nextCourseCount <= 5) {
                //取最後十筆
                $courseArray = Course::orderBy('time', 'desc')->take(10)->get()->toArray();
            } else if ($prevCourseCount <= 5) {
                //取最早十筆
                $courseArray = Course::orderBy('time', 'asc')->take(10)->get()->toArray();
            } else {
                //取前後各五筆
                $prev5CourseArray = Course::where('time', '<', Carbon::now()->toDateTimeString())->orderBy('time', 'desc')->take(5)->get()->toArray();
                $next5CourseArray = Course::where('time', '>=', Carbon::now()->toDateTimeString())->orderBy('time', 'asc')->take(5)->get()->toArray();
                //合併為array
                $courseArray = array_merge($prev5CourseArray, $next5CourseArray);
            }
            //根據時間排序
            usort($courseArray, function ($a, $b) {
                return $a['time'] > $b['time'];
            });
            //放入Collection
            foreach ($courseArray as $courseItem) {
                $courseList->add(Course::find($courseItem['id']));
            }
            //下次時間
            $nextCourse = Course::where('time', '>=', Carbon::now()->toDateTimeString())->orderBy('time', 'asc')->first();
            if ($nextCourse) {
                $nextCourseTime = $nextCourse->time;
            }
        }
        return view('home')->with('courseList', $courseList)->with('nextCourseTime', $nextCourseTime);
    }
}
