<?php namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
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
    public function index(Request $request)
    {
        if ($request->has('tag')) {
            $tag = $request->get('tag');
            $courseList = Course::withAllTags($tag)->orderBy('time', 'desc')->paginate(20);
        } else {
            $courseList = Course::orderBy('time', 'desc')->paginate(20);
        }
        $existingTags = Course::existingTags();
        return view('course.list')->with('courseList', $courseList)->with('existingTags', $existingTags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            array(
                'subject' => 'required|max:100',
                'description' => 'max:100',
                'lecturer' => 'max:100',
                'time' => 'required|date',
                'location' => 'max:20',
            )
        );

        if ($validator->fails()) {
            return Redirect::route('course.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $course = Course::create(array(
                'subject' => $request->get('subject'),
                'description' => $request->get('description'),
                'lecturer' => $request->get('lecturer'),
                'time' => $request->get('time'),
                'location' => $request->get('location')
            ));
            //更新標籤
            if ($request->has('tag')) {
                $course->retag($request->get('tag'));
            } else {
                $course->untag();
            }

            return Redirect::route('course.show', $course->id)
                ->with('global', '課程資料已更新');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public
    function show($id)
    {
        $user = Auth::user();
        $course = Course::find($id);
        if ($course) {
            return view('course.show')->with('user', $user)->with('course', $course);
        }
        return Redirect::route('course.index')
            ->with('warning', '課程不存在');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public
    function edit($id)
    {
        $course = Course::find($id);
        if ($course) {
            $existingTags = Course::existingTags();
            $tags = [];
            foreach ($existingTags as $tag) {
                $tags[] = $tag->name;
            }
            $tagsString = "['" . implode("','", $tags) . "']";

            return view('course.edit')->with('course', $course)->with('tags', $tags)->with('tagsString', $tagsString);
        }
        return Redirect::route('course.index')
            ->with('warning', '課程不存在');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public
    function update(Request $request, $id)
    {
        $course = Course::find($id);
        if (!$course) {
            return Redirect::route('course.index')
                ->with('warning', '課程不存在');
        }

        $validator = Validator::make($request->all(),
            array(
                'subject' => 'required|max:100',
                'description' => 'max:100',
                'lecturer' => 'max:100',
                'time' => 'required|date',
                'location' => 'max:20',
                'info' => 'max:65535',
                'link' => 'max:65535',
            )
        );

        if ($validator->fails()) {
            return Redirect::route('course.edit', $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $course->subject = $request->get('subject');
            $course->description = $request->get('description');
            $course->lecturer = $request->get('lecturer');
            $course->time = $request->get('time');
            $course->location = $request->get('location');
            $course->info = $request->get('info');
            $course->link = $request->get('link');
            $course->save();
            //更新標籤
            if ($request->has('tag')) {
                $course->retag($request->get('tag'));
            } else {
                $course->untag();
            }

            return Redirect::route('course.show', $id)
                ->with('global', '課程資料已更新');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public
    function destroy($id)
    {
        $course = Course::find($id);
        //移除標籤
        $course->untag();
        //移除課程
        $course->delete();
        return Redirect::route('course.index')
            ->with('global', '課程已刪除');
    }

}
