<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\API\BidController;
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
            $res = DB::select("SELECT id FROM auction WHERE title @@ plainto_tsquery('english',?)", [$request->input('title')]);
            array_push($queryResults, $res);
        }
        if ($request->input('author') != null)
        {
            $res = DB::select("SELECT id FROM auction WHERE author = ?", [$request->input('author')]);
            array_push($queryResults, $res);
        }
        if ($request->input('isbn') != null)
        {
            $res = DB::select("SELECT id FROM auction WHERE isbn = ?", [$request->input('isbn')]);
            array_push($queryResults, $res);
        }
        if ($request->input('auctionStatus') != null)
        {
            $res = DB::select("SELECT id FROM auction WHERE auction_status = ?", [$request->input('auctionStatus')]);
            array_push($queryResults, $res);
        }
        if ($request->input('maxBid') != null)
        {
            $res = DB::select("SELECT DISTINCT auction.id FROM auction, bid WHERE bid.idAuction = auction.id and bidValue < ?", [$request->input('maxBid')]);
            array_push($queryResults, $res);
        }
        if ($request->input('wishlistOfUser') != null)  //gets auctions in wishlist of user (this is just a flag, doesn't need to have a value)
        {
            $res = DB::select("SELECT DISTINCT auction.id FROM auction, wishlist WHERE wishlist.idAuction = auction.id and wishlist.idBuyer = ?", [Auth::user()->id]);
            array_push($queryResults, $res);
        }
        if ($request->input('auctionsOfUser') != null)  //gets auctions of user (this is just a flag, doesn't need to have a value)
        {
            $res = DB::select("SELECT DISTINCT auction.id FROM auction WHERE idSeller = ?", [$request->input(Auth::user()->id)]);
            array_push($queryResults, $res);
        }
        if ($request->input('userBidOn') != null)  //gets auctions in which the user bid on (this is just a flag, doesn't need to have a value)
        {
            $res = DB::select("SELECT DISTINCT auction.id FROM auction, bid WHERE bid.idAuction = auction.id and bid.idBuyer = ?", [$request->input(Auth::user()->id)]);
            array_push($queryResults, $res);
        }
        if ($request->input('language') != null)
        {
            $res = DB::select("SELECT DISTINCT auction.id FROM auction, language WHERE auction.idLanguage = language.id and language.languageName = ?", [$request->input('language')]);
            array_push($queryResults, $res);
        }
        if ($request->input('publisher') != null)
        {
            $res = DB::select("SELECT DISTINCT auction.id FROM auction, publisher WHERE auction.idPublisher = publisher.id and publisher.publisherName = ?", [$request->input('publisher')]);
            array_push($queryResults, $res);
        }

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
        if ($ids === "")
            $ids = "-1";
        $query = "SELECT auction.id, title, author, duration, dateApproved FROM auction WHERE auction.id IN (" . $ids . ")";
        $response = DB::select($query, []);

        foreach ($response as $auction)
        {
            $auction->maxBid = BidController::getMaxBidInternal($auction->id);
            if (array_key_exists ("dateApproved", $auction))
                $auction->time = AuctionController::createTimestamp($auction->dateApproved, $auction->duration);
            else
                $auction->time = "Not yet started";
        }

        return response()->json($response);
    }
}
