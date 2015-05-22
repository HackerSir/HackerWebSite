<?php namespace App\Http\Controllers;

use App\Course;
use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Illuminate\Database\Eloquent\Collection;
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
        //找出下一次上課時間
        $nextCourse = Course::where('time', '>=', Carbon::now()->toDateTimeString())->first();
        $nextCourseTime = Carbon::now()->toDateTimeString();
        if ($nextCourse) {
            $nextCourseTime = $nextCourse->time;
            //找出前後最多五筆課程資料
            $prev5CourseList = Course::where('time', '<', $nextCourseTime)->orderBy('time', 'desc')->take(5)->get();
            $next5CourseList = Course::where('time', '>=', $nextCourseTime)->orderBy('time', 'asc')->take(5)->get();
            //合併為array
            $courseArray = array_merge($prev5CourseList->toArray(), $next5CourseList->toArray());
            //根據時間排序
            usort($courseArray, function ($a, $b) {
                return $a['time'] > $b['time'];
            });
        } else {
            //找出最新十筆課程資料
            $courseArray = Course::orderBy('time', 'desc')->take(5)->get()->toArray();
            //根據時間排序
            usort($courseArray, function ($a, $b) {
                return $a['time'] > $b['time'];
            });

        }
        //建立Collection
        $courseList = new Collection();
        foreach ($courseArray as $courseItem) {
            $courseList->add(Course::find($courseItem['id']));
        }
        /*
        if ($request->has('tag')) {
            $tag = $request->get('tag');
            $courseList = Course::withAllTags($tag)->orderBy('time', 'desc')->paginate(20);
        } else {
            $courseList = Course::orderBy('time', 'desc')->paginate(20);
        }*/

        return view('home')->with('courseList', $courseList)->with('nextCourseTime', $nextCourseTime);
    }

}
