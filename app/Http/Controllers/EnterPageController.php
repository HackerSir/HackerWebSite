<?php namespace App\Http\Controllers;

use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class EnterPageController extends Controller
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
    public function index()
    {
        if (Session::get('firstCome')==NULL){
            Session::put('firstCome', Carbon::now()->timestamp);
        }
        return view('entrance')->with('firstCome', Session::get('firstCome'));

    }

}
