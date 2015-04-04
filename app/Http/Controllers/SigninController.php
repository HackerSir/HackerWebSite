<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Signin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SigninController extends Controller
{

    public function destroy($id)
    {
        $signin = Signin::find($id);
        $courseId = $signin->course_id;
        $signin->delete();
        return Redirect::route('course.show', $courseId)
            ->with('global', '簽到記錄已刪除');
    }
}
