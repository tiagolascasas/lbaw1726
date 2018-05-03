<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Auction;
use App\AuctionModification;

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
      $auction_modifications = AuctionModification::where('dateapproved',null)->get();
      $auction_modifications_ids = AuctionModification::where('dateapproved',null)->get()->pluck('id');
      $auctions_to_mod = Auction::whereIn('id',$auction_modifications_ids)->get();
      
      return view('pages.moderator',['auctions'=>$auctions,'auction_modifications'=>$auction_modifications,'auctions_to_mod'=>$auctions_to_mod]);
    }

    /**
    *
    * Aprove a new auction
    *
    */
    private function db_approve($id){
        $auction = Auction::find($id);
        $auction->auction_status = 'approved';
        $auction->dateapproved = DB::raw('now()');
        $auction->save();
    }

    private function db_remove($id){
        $auction = Auction::find($id);
        $auction->auction_status = 'removed';
        $auction->save();
    }

    private function db_approve_mod($id){
        $auction = Auction::find($id);
        $auction_modified = AuctionModification::where('idapprovedauction', $id)->first();

        $auction_modified->dateapproved = DB::raw('now()');
        $auction_modified->is_approved = true;
        $auction_modified->save();

        $auction->description = $auction_modified->newdescription;
        $auction->save();
    }

    private function db_remove_mod($id){
        $auction_modified = AuctionModification::where('idapprovedauction', $id)->first();

        $auction_modified->dateapproved = DB::raw('now()');
        $auction_modified->is_approved = false;
        $auction_modified->save();
    }

    public function approve($id){
        // add authentification check
        
        $this->db_approve($id);

        //change to ajax
      $auctions = Auction::where('auction_status', "waitingApproval")->get();
      $auction_modifications = AuctionModification::where('dateapproved',null)->get();
      $auction_modifications_ids = AuctionModification::where('dateapproved',null)->get()->pluck('id');
      $auctions_to_mod = Auction::whereIn('id',$auction_modifications_ids)->get();
      return view('pages.moderator',['auctions'=>$auctions,'auction_modifications'=>$auction_modifications,'auctions_to_mod'=>$auctions_to_mod]);
    }

    public function remove($id){
        //add authentification check

        $this->db_remove($id);

        //change to ajax
      $auctions = Auction::where('auction_status', "waitingApproval")->get();
      $auction_modifications = AuctionModification::where('dateapproved',null)->get();
      $auction_modifications_ids = AuctionModification::where('dateapproved',null)->get()->pluck('id');
      $auctions_to_mod = Auction::whereIn('id',$auction_modifications_ids)->get();
      return view('pages.moderator',['auctions'=>$auctions,'auction_modifications'=>$auction_modifications,'auctions_to_mod'=>$auctions_to_mod]);
    }

    public function approve_mod($id){
        // add authentification check
        
        $this->db_approve_mod($id);

        //change to ajax
      $auctions = Auction::where('auction_status', "waitingApproval")->get();
      $auction_modifications = AuctionModification::where('dateapproved',null)->get();
      $auction_modifications_ids = AuctionModification::where('dateapproved',null)->get()->pluck('id');
      $auctions_to_mod = Auction::whereIn('id',$auction_modifications_ids)->get();
      return view('pages.moderator',['auctions'=>$auctions,'auction_modifications'=>$auction_modifications,'auctions_to_mod'=>$auctions_to_mod]);
    }

    public function remove_mod($id){
        //add authentification check

        $this->db_remove_mod($id);

        //change to ajax
      $auctions = Auction::where('auction_status', "waitingApproval")->get();
      $auction_modifications = AuctionModification::where('dateapproved',null)->get();
      $auction_modifications_ids = AuctionModification::where('dateapproved',null)->get()->pluck('id');
      $auctions_to_mod = Auction::whereIn('id',$auction_modifications_ids)->get();
      return view('pages.moderator',['auctions'=>$auctions,'auction_modifications'=>$auction_modifications,'auctions_to_mod'=>$auctions_to_mod]);
    }
}
