<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function anyTest($code)
    {
        $json = array(
            "http status code" => $code,
            "message" => "This is a test message with http status code " . $code,
            "somthings" => array(
                "blabla",
                "Hello, world",
                "Nothing here"
            ),
        );
        return Response::json($json, $code);
    }
}
