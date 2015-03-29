<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VoteController extends Controller
{

    public function getIndex()
    {
        return File::get('vote/index.html');;
    }

}
