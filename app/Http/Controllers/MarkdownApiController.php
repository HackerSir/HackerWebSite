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
        return Response::make(Markdown::parse($request->instance()->getContent()));
    }
}
