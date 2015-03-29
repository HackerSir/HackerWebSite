<?php namespace App\Http\Controllers;

use App\Booth;
use App\Candidate;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;


class VoteApiController extends Controller
{
    public function __construct()
    {
        //學生會限定
        $this->middleware('sa', ['only' => ['anyVote']]);
    }

    public function anyVotes($id = null)
    {
        //ID轉換
        $boothId = null;
        if ($id != null) {
            $booth = Booth::distinct('id')->select('id')->get()->toArray();
            $boothId = $booth[$id]['id'];
        }

        $votes = array();
        //分類
        $subTypeList = [];
        $departmentList = Candidate::where('type', '!=', "學生會會長")->distinct('department')->select('department')->get();
        foreach (Config::get('vote.type') as $voteType) {
            if ($voteType == "學生會會長") {
                $subType = array(
                    "type" => $voteType,
                    "name" => $voteType
                );
                $subTypeList[] = $subType;
            } else {
                foreach ($departmentList as $department) {
                    $subType = array(
                        "type" => $voteType,
                        "name" => $department["department"] . $voteType,
                        "department" => $department["department"]
                    );
                    //計算該種類該科系候選人人數
                    $candidateCount = Candidate::where('type', '=', $subType["type"])->where('department', '=', $subType['department'])->count();
                    if ($candidateCount > 0) {
                        $subTypeList[] = $subType;
                    }
                }
            }

        }

        //對應資料
        foreach ($subTypeList as $subType) {
            $voteLabel = array();
            $voteVotes = array();
            if ($subType["name"] == "學生會會長") {
                $candidateList = Candidate::where('type', '=', $subType["type"])->get();
            } else {
                $candidateList = Candidate::where('type', '=', $subType["type"])->where('department', '=', $subType['department'])->get();
            }

            foreach ($candidateList as $candidate) {
                if (!$candidate->canVote()) {
                    continue;
                }
                $voteLabel[] = $candidate->name;
                $voteVotes[] = +$candidate->voteCount($boothId);
            }

            $votes[] = array(
                "name" => $subType['name'],
                "labels" => $voteLabel,
                "votes" => $voteVotes,
            );
        }

        //投票所資料
        if ($boothId == null) {
            $boothName = "總合計";
            $boothUrl = "http://hackersir.info";
        } else {
            $booth = Booth::find($boothId);
            $boothName = $booth->name;
            $boothUrl = $booth->url;
        }

        $json = array(
            "name" => $boothName,
            "url" => $boothUrl,
            "votes" => $votes
        );
        return Response::json($json);
    }

    public function anyBoothCount()
    {
        $boothCount = Booth::count();
        return Response::json($boothCount);
    }

    public function anyVote(Request $request)
    {
        //只接受Ajax請求
        if (!$request->ajax()) {
            return "error";
        }
        $data = Input::all();
        //取得候選人
        $candidate = Candidate::find($data['candidate']);
        //更改票數
        $vote = Vote::where('booth_id', '=', $data['booth'])->where('candidate_id', '=', $data['candidate'])->first();
        if ($data['action'] == 'add') {
            $vote->count++;
        } else if ($data['action'] == 'minus' && $vote->count > 0) {
            $vote->count--;
        }
        $vote->save();

        $result = array(
            'success' => true,
            'count' => $vote->count
        );
        return Response::json($result);
    }

}
