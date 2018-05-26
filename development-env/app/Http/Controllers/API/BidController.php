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
        if ($response[0]->max == null)
            $response[0]->max = 0.00;

        return response()->json($response[0]);
    }

    public static function getMaxBidInternal($id)
    {
        $query = "SELECT max(bidValue) FROM bid WHERE idAuction = ?";
        $response = DB::select($query, [$id]);
        if ($response[0]->max == null)
            $response[0]->max = 0.00;

        return $response[0]->max;
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

        $message = "";
        $success = true;
        $info = "Your bid has been beaten.";

        $exists = DB::select("SELECT * FROM bid WHERE idBuyer = ? and idAuction = ?", [$userID, $auctionID]);
        if (sizeof($exists) > 0)
        {
            DB::update("UPDATE bid SET bidValue = ?, bidDate = now() WHERE idBuyer = ? AND idAuction = ?", [$bidValue, $userID, $auctionID]);
            $message = "Successfully updated your previous bid. You are now leading the auction!";
        }
        else
        {
            $lastbidder = DB::select('SELECT bid.idBuyer FROM bid WHERE idAuction = ?', [$auctionID]);

            DB::insert("INSERT INTO bid (idBuyer, idAuction, bidValue) VALUES (?, ?, ?)", [$userID, $auctionID, $bidValue]);
            $message = "Successfully registered your bid. You are now leading the auction!";
            DB::insert("INSERT INTO notification (information, idusers) VALUES (?,?)",[$info,$lastbidder]);
        }



        return response()->json(['success' => $success, 'message' => $message]);
    }
}
