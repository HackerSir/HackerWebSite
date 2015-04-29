<?php namespace App\Http\Controllers;

use App\Card;
use App\Course;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('api', [
            'except' => [
                'anyGetToken'
            ]
        ]);
    }

    /*
     * 直接訪問/api
     */
    public function anyIndex()
    {
        abort(400);
    }

    //==================== 測試用 ====================
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

    //==================== 驗證 ====================
    /*
     * 取得token
     */
    public function anyGetToken()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        if (empty($username) || empty($password)) {
            $json = [
                "status" => 2,
                "message" => "Arguments Error"
            ];
        } else {
            if (Auth::once(['email' => $username, 'password' => $password])) {
                $user = Auth::user();
                if ($user->isStaff()) {
                    //找出用戶所有未過期token，並立刻過期
                    $activeTokens = $user->activeTokens();
                    foreach ($activeTokens as $activeToken) {
                        $activeToken->deadline = date('Y-m-d H:i:s', time());
                        $activeToken->save();
                    }
                    //生成新token
                    $token = str_random(20);
                    Token::create([
                        'user_id' => $user->id,
                        'token' => $token,
                        'deadline' => date('Y-m-d H:i:s', time() + 6 * 60 * 60)
                    ]);
                    $json = [
                        "status" => 0,
                        "message" => "Success",
                        "token" => $token
                    ];
                } else {
                    $json = [
                        "status" => 1,
                        "message" => "Permission Denied (Not staff?)"
                    ];
                }
            } else {
                $json = [
                    "status" => 1,
                    "message" => "Permission Denied (Login Failed?)"
                ];
            }
        }
        return Response::json($json);
    }

    //==================== 一般API ====================
    /*
     * 列出卡片清單
     */
    public function anyListCards()
    {
        $cards = Card::whereNotIn('card_number', [''])->get();
        $data = [];
        foreach ($cards as $card) {
            $data[$card->nid] = $card->card_number;
        }
        $json = [
            "status" => 0,
            "message" => "Success",
            "data" => $data
        ];
        return Response::json($json);
    }

    /*
     * 綁定NID與卡號
     */
    public function anyBindNid()
    {
        $nid = strtoupper(Input::get('nid'));
        $cid = Input::get('cid');

        if (empty($nid) || empty($cid)) {
            $json = [
                "status" => 2,
                "message" => "Arguments Error"
            ];
        } else {
            if (Card::where('nid', '=', $nid)->whereNotIn('card_number', [''])->count() > 0) {
                $json = [
                    "status" => 4,
                    "message" => "Bind Failed (Same nid)"
                ];
            } else if (Card::where('card_number', '=', $cid)->count() > 0) {
                $json = [
                    "status" => 4,
                    "message" => "Bind Failed (Same cid)"
                ];
            } else {
                $card = Card::updateOrCreate(array(
                    "nid" => $nid
                ), array(
                    "card_number" => $cid,
                ));
                $json = [
                    "status" => 0,
                    "message" => "Success"
                ];
            }
        }
        return Response::json($json);
    }

    /*
     * 取得NID
     */
    public function anyGetNid()
    {
        $cid = Input::get('cid');
        if (empty($cid)) {
            $json = [
                "status" => 2,
                "message" => "Arguments Error"
            ];
        } else {
            $card = Card::where('card_number', '=', $cid)->first();
            if ($card) {
                $json = [
                    "status" => 0,
                    "message" => "Success",
                    "nid" => $card->nid
                ];
            } else {
                $json = [
                    "status" => 5,
                    "message" => "Data Not Found"
                ];
            }
        }
        return Response::json($json);
    }

    /*
     * 取得卡號
     */
    public function anyGetCid()
    {
        $nid = strtoupper(Input::get('nid'));
        if (empty($nid)) {
            $json = [
                "status" => 2,
                "message" => "Arguments Error"
            ];
        } else {
            $card = Card::where('nid', '=', $nid)->whereNotIn('card_number', [''])->first();
            if ($card) {
                $json = [
                    "status" => 0,
                    "message" => "Success",
                    "cid" => $card->card_number
                ];
            } else {
                $json = [
                    "status" => 5,
                    "message" => "Data Not Found"
                ];
            }
        }
        return Response::json($json);
    }

    /*
     * 列出活動清單
     */
    public function anyListEvents()
    {
        $courses = Course::all();
        $data = [];
        foreach ($courses as $course) {
            $data[] = [
                "eid" => $course->id,
                "time" => $course->time,
                "name" => $course->subject
            ];
        }
        $json = [
            "status" => 0,
            "message" => "Success",
            "data" => $data
        ];
        return Response::json($json);
    }

    /*
     * 取的活動資料
     */
    public function anyGetEventData()
    {
        $eid = Input::get('eid');
        if (empty($eid)) {
            $json = [
                "status" => 2,
                "message" => "Arguments Error"
            ];
        } else {
            $course = Course::find($eid);
            if ($course) {
                $json = [
                    "status" => 0,
                    "message" => "Success",
                    "time" => $course->time,
                    "name" => $course->subject,
                    "category" => $course->tagNames()
                ];
            } else {
                $json = [
                    "status" => 5,
                    "message" => "Data Not Found"
                ];
            }
        }
        return Response::json($json);
    }

    /*
     * 取得活動參與者（簽到清單）
     */
    public function anyGetEventParticipant()
    {
        $eid = Input::get('eid');
        if (empty($eid)) {
            $json = [
                "status" => 2,
                "message" => "Arguments Error"
            ];
        } else {
            $course = Course::find($eid);
            if ($course) {
                $participants = [];
                foreach ($course->signins as $signin) {
                    if (!empty($signin->card->card_number)) {
                        $participants[] = [
                            "nid" => $signin->card->nid,
                            "cid" => $signin->card->card_number
                        ];
                    }
                }
                $json = [
                    "status" => 0,
                    "message" => "Success",
                    "time" => $course->time,
                    "name" => $course->subject,
                    "participants" => $participants
                ];
            } else {
                $json = [
                    "status" => 5,
                    "message" => "Data Not Found"
                ];
            }
        }
        return Response::json($json);
    }

    /*
     * 所有沒處理到的情況
     */
    public
    function missingMethod($parameters = array())
    {
        abort(400);
    }
}
