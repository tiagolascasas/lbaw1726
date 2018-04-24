<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        {   
            if ( $request->ajax() || $request->pjax()){
                if($request->input('type_search')=='home'){
                    $response;
                    if(Auth::check())
                        $response=DB::select('select * from auction where auction_status = ? AND idSeller!=?', ['approved',Auth::user()->id]);
                    else
                        $response=DB::select('select * from auction where auction_status = ?',['approved']);
                    return response()->json($response);
                }
            }else return response('Forbidden.', 403);

            return response('Error', 400)
                  ->header('Content-Type', 'text/plain');
        }
    }
}
