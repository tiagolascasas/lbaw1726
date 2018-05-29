<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuctionController;

class HomeController extends Controller
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

    public function show()
    {
        $auctions = Auction::all();
        (new AuctionController)->updateAuctions();
        return view('pages.home', ['auctions' => $auctions]);

    }
}
