<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
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

    public function getMaxBid(Request $request)
    {
        if ( !($request->ajax() || $request->pjax()))
        {
            return response('Forbidden.', 403);
        }
        $response = [];

        return response()->json($response);
    }

    public function bidNewValue(Request $request)
    {
        if ( !($request->ajax() || $request->pjax()))
        {
            return response('Forbidden.', 403);
        }
        $response = [];

        return response()->json($response);
    }
}
