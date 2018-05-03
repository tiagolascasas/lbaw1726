<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Auction;

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

    public function show($searchTerm)
    {
        $auctions = DB::select('select distinct * from auction, image where auction_status = ? and title = ? and auction.id = image.idAuction group by title limit 12',['approved', $searchTerm]);

        return view('pages.search', ['auctions' => $auctions]);
    }
}
