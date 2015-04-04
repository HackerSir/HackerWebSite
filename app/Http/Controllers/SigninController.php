<?php namespace App\Http\Controllers;

use App\Card;
use App\Course;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Signin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SigninController extends Controller
{
    public function create($courseId)
    {
        $course = Course::find($courseId);
        if ($course) {
            return view('signin.create')->with('course', $course);
        }
        return Redirect::route('course.index')
            ->with('warning', '課程不存在');
    }

    public function store(Request $request, $courseId)
    {
        $validator = Validator::make($request->all(),
            array(
                'time' => 'required|date',
                'nid' => ['required', 'regex:/^((([depm]([0-9]){7})|(t[0-9]{5}))(\\n\\r?|\\r\\n?|$)+)+$/i']
            )
        );

        if ($validator->fails()) {
            return Redirect::route('signin.create', $courseId)
                ->withErrors($validator)
                ->withInput();
        } else {
            $time = $request->get('time');
            //逐行處理
            foreach (preg_split("/((\r?\n)|(\r\n?))/", $request->get('nid')) as $nid) {
                if (empty($nid)) {
                    continue;
                }
                $card = Card::firstOrCreate(array(
                    'nid' => $nid
                ));
                if (Signin::where('course_id', '=', $courseId)->where('card_id', '=', $card->id)->count() == 0) {
                    $signin = Signin::create(array(
                        'time' => $time,
                        'card_id' => $card->id,
                        'course_id' => $courseId
                    ));
                }
            }
            return Redirect::route('course.show', $courseId)
                ->with('global', '簽到記錄已更新');
        }
    }

    public function destroy($id)
    {
        $signin = Signin::find($id);
        $courseId = $signin->course_id;
        $signin->delete();
        return Redirect::route('course.show', $courseId)
            ->with('global', '簽到記錄已刪除');
    }
}
