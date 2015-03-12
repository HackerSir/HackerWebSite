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

    /*
     * 直接訪問/api
     */
    public function anyIndex()
    {
        abort(400);
    }

    /*
     * 測試Http status code
     */
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

    /*
     * 測試Json input
     */
    public function postTestJson(Request $request, $token = null)
    {
        //檢查是否為JSON
        if (!$request->isJson()) {
            return "Request must be json, not " . $request->header('Content-Type');
        }
        $json = (object)$request->all();
        $result = array(
            "Token" => $token,
            "JSON Input" => $json
        );
        return Response::json($result);
    }

    /*
     * 所有沒處理到的情況
     */
    public function missingMethod($parameters = array())
    {
        abort(400);
    }
}
