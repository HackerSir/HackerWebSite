<?php namespace App\Http\Controllers;

use App\Card;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    public function __construct()
    {
        //限工作人員
        $this->middleware('staff');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $cardList = Card::orderBy('nid', 'asc')->paginate(20);
        return view('card.list')->with('cardList', $cardList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('card.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            array(
                'nid' => ['size:8', 'regex:/^([depm]([0-9]){7})|(t[0-9]{5})$/i', 'unique:cards'],
                'grade' => 'max:20',
                'name' => 'max:20'
            )
        );

        if ($validator->fails()) {
            return Redirect::route('card.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $card = Card::create(array(
                'nid' => strtoupper($request->get('nid')),
                'grade' => $request->get('grade'),
                'name' => $request->get('name')
            ));

            return Redirect::route('card.show', $card->id)
                ->with('global', '卡片資料已更新');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $card = Card::find($id);
        if ($card) {
            return view('card.show')->with('card', $card);
        }
        return Redirect::route('card.index')
            ->with('warning', '卡片不存在');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $card = Card::find($id);
        if ($card) {
            return view('card.edit')->with('card', $card);
        }
        return Redirect::route('card.index')
            ->with('warning', '卡片不存在');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $card = Card::find($id);
        if (!$card) {
            return Redirect::route('card.index')
                ->with('warning', '卡片不存在');
        }

        $validator = Validator::make($request->all(),
            array(
                'grade' => 'max:20',
                'name' => 'max:20'
            )
        );

        if ($validator->fails()) {
            return Redirect::route('card.edit', $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $card->grade = $request->get('grade');
            $card->name = $request->get('name');
            $card->save();

            return Redirect::route('card.show', $id)
                ->with('global', '卡片資料已更新');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $card = Card::find($id);
        $card->delete();
        return Redirect::route('card.index')
            ->with('global', '卡片已刪除');
    }

}
