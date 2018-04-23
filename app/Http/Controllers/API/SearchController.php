<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(Request $request){
        {   $response;
            if(Auth::check())
                $response=DB::select('select * from auction where auction_status = approved AND idSeller!=?', [Auth::user()->id]);
            else
                $response=DB::select('select * from auction where auction_status = approved');
            echo var_dump($response);
            return response()->json($response);
        }
    }
}
