<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use AlfredoRamos\ParsedownExtra\Facades\ParsedownExtra as Markdown;

class MarkdownApiController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        //
    }

    public function markdownPreview(Request $request)
    {
        //只接受Ajax請求
        if (!$request->ajax()) {
            return "error";
        }
        $data = $request->getContent();
        //檢查是否有內容
        if(empty($data)){
            return Response::make(" ");
        }
        return Response::make(Markdown::parse($data));
    }
}
