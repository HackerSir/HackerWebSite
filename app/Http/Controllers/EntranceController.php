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
        $firstCome = Session::get('firstCome');
        $nowTime = Carbon::now()->timestamp;
        $beginTime = Carbon::create(2015, 6, 4, 0, 0, 0)->timestamp;
        $endTime = Carbon::create(2015, 6, 9, 23, 59, 59)->timestamp;
        if ($firstCome != NULL || ($firstCome == NULL && ($nowTime < $beginTime || $nowTime > $endTime))) {
            return Redirect::route('home');
        } else {
            return Redirect::route('enter-page');
        }

    }

}
