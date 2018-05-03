<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Auction;

class ModeratorController extends Controller
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
      $auctions = Auction::where('auction_status', "waitingApproval")->get();  
      return view('pages.moderator',['auctions'=>$auctions]);
    }

    public function approve($id){
        $auction = Auction::find($id);
        $auction->auction_status = 'approved';
        $auction->save();
    }

    public function reject($id){
        $auction = Auction::find($id);
        $auction->auction_status = 'rejected';
        $auction->save();
    }
}
