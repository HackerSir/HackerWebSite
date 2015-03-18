<?php namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
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
        $courseList = Course::paginate(20);
        return view('course.list')->with('courseList', $courseList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return "create()";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        return "store()";
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        if ($course) {
            return view('course.show')->with('course', $course);
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
    public function edit($id)
    {
        $course = Course::find($id);
        if ($course) {
            return view('course.edit')->with('course', $course);
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
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        if (!$course) {
            return Redirect::route('course.index')
                ->with('warning', '課程不存在');
        }

        $validator = Validator::make($request->all(),
            array(
                'subject' => 'required|max:100',
                'lecturer' => 'max:100',
                'time' => 'required|date',
            )
        );

        if ($validator->fails()) {
            return Redirect::route('course.edit', $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $course->subject = $request->get('subject');
            $course->lecturer = $request->get('lecturer');
            $course->time = $request->get('time');
            $course->save();

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
    public function destroy($id)
    {
        return "destroy($id)";
    }

}
