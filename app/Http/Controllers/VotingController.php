<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class VotingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return 'index()';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return 'create()';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return 'store()';
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return 'show($id)';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        return 'edit($id)';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        return 'update($id, Request $request)';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        return 'destroy($id)';
    }

    //額外function
    //開始投票
    public function start($id)
    {
        return 'start($id)';
    }

    //結束投票
    public function end($id)
    {
        return 'end($id)';
    }

    //額外頁面
    //投票頁面
    public function vote($id, Request $request)
    {
        return 'vote($id, Request $request)';
    }

    //開票頁面
    public function billing($id)
    {
        return 'billing($id)';
    }

}
