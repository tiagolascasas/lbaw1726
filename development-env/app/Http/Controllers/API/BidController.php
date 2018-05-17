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

        $auctionID = $request->input('auctionID');
        $query = "SELECT max(bidValue) FROM bid WHERE idAuction = ?";
        $response = DB::select($query, [$auctionID]);

        return response()->json($response[0]);
    }

    public function bidNewValue(Request $request)
    {
        if ( !($request->ajax() || $request->pjax() || Auth::check()))
        {
            return response('Forbidden.', 403);
        }

        $auctionID = $request->input('auctionID');
        $userID = Auth::user()->id;
        $bidValue = $request->input('value');

        $exists = DB::select("SELECT * FROM bid WHERE idBuyer = ? and idAuction = ?", [$userID, $auctionID]);
        if (sizeof($exists) > 0)
        {
            DB::update("UPDATE bid SET bidValue = ?, bidDate = now() WHERE idBuyer = ? AND idAuction = ?", [$bidValue, $userID, $auctionID]);
            error_log("UPDATING");
        }
        else
        {
            DB::insert("INSERT INTO bid (idBuyer, idAuction, bidValue) VALUES (?, ?, ?)", [$userID, $auctionID, $bidValue]);
            error_log("INSERTING");
        }

        return response()->json(['success' => "true"]);
    }
}
