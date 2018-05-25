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

    public function search(Request $request)
    {
        if ( !($request->ajax() || $request->pjax()))
        {
            return response('Forbidden.', 403);
        }

        $queryResults = [];

        if ($request->input('keywords') != null)
        {

        }
        if ($request->input('title') != null)
        {
            $res = DB::select("SELECT id FROM auction WHERE title @@ plainto_tsquery('english',?) limit 30", [$request->input('title')]);
            array_push($queryResults, $res);
        }
        if ($request->input('author') != null)
        {
            $res = DB::select("SELECT id FROM auction WHERE author = ? limit 30", [$request->input('author')]);
            array_push($queryResults, $res);
        }
        if ($request->input('isbn') != null)
        {
            $res = DB::select("SELECT id FROM auction WHERE isbn = ? limit 30", [$request->input('isbn')]);
            array_push($queryResults, $res);
        }
        if ($request->input('auctionStatus') != null)
        {
            $res = DB::select("SELECT id FROM auction WHERE auction_status = ? limit 30", [$request->input('auctionStatus')]);
            array_push($queryResults, $res);
        }
        if ($request->input('maxBid') != null)
        {
            $res = DB::select("SELECT DISTINCT auction.id FROM auction, bid WHERE bid.idAuction = auction.id and bidValue < ? limit 30", [$request->input('maxBid')]);
            array_push($queryResults, $res);
        }
        //add the parameters with weird queries

        $counts = [];
        foreach ($queryResults as $res)
        {
            foreach ($res as $id)
            {
                if (!array_key_exists($id->id, $counts))
                    $counts[$id->id] = 1;
                else
                    $counts[$id->id]++;
            }
        }
        arsort($counts);
        $counts = array_unique(array_keys($counts));

        $ids = implode(",", array_values($counts));
        $query = "SELECT auction.id, title, author, duration, dateApproved FROM auction WHERE auction.id IN (" . $ids . ")";
        $response = DB::select($query, []);

        return response()->json($response);
    }
}
