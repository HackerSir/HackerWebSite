<?php namespace App\Http\Controllers;

use App\Course;
use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

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
     *
     * @return Response
     */
    public function index(Request $request)
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

    public function entrance()
    {
        $nowtime = Carbon::now()->timestamp;
        $begintime = Carbon::create(2015, 6, 4, 0, 0, 0)->timestamp;
        $endtime = Carbon::create(2015, 6, 9, 23, 59, 59)->timestamp;
        if ( $nowtime > $begintime && $nowtime <= $endtime){
            return view('entrance');
        }
        else {
            return Redirect::route('home');
        }
    }

}
