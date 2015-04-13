<?php namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function __construct()
    {
        //限工作人員
        $this->middleware('staff');
    }

    public function getSigninList($courseId)
    {
        $course = Course::find($courseId);
        if ($course == null) {
            return Redirect::back()->with('warning', '課程不存在');
        }
        if ($course->signins->count() == 0) {
            return Redirect::back()->with('warning', '無簽到記錄');
        }

        $data = array();

        foreach ($course->signins as $signin) {
            $data[] = array($signin->card->nid);
        }

        $date = new DateTime($course->time);
        $fileName = $date->format('Y-m-d') . ' - 簽到清單';

        Excel::create($fileName, function ($excel) use ($data, $date) {
            $excel->setTitle($date->format('Y-m-d') . ' - SignList');
            $excel->setCreator('HackerSir');
            $excel->setDescription($date->format('Y-m-d') . ' - SignList');

            $excel->sheet('SignList', function ($sheet) use ($data) {
                $sheet->fromArray($data, null, 'A1', false, false);
            });
        })->download('xls');
    }
}
