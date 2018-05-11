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

    private function isNotModerator(){
      if (Auth::user()->users_status!="moderator")
        return true;
    }

    public function show()
    {
      if ($this->isNotModerator())
        return redirect('home');

      $auctions = Auction::where('auction_status', "waitingApproval")->get(); //new auctions
      $auction_modifications = AuctionModification::where('dateapproved',null)->get(); //auctions waiting mod
      $auction_modifications_ids = AuctionModification::where('dateapproved',null)->get()->pluck('idapprovedauction');
      $auctions_to_mod = Auction::whereIn('id',$auction_modifications_ids)->get(); //the auction's data of all the auctions requests for modification
      
      return view('pages.moderator',['auctions'=>$auctions,'auction_modifications'=>$auction_modifications,'auctions_to_mod'=>$auctions_to_mod]);
    }

    private function db_remove_auction($id){
        DB::table('auction')
          ->where('id', $id)
          ->update(['auction_status' => 'removed','dateremoved' => 'now()']);
    }

    /**
    *
    * Aprove a new auction
    *
    */
    private function db_approve_creation($id){
        DB::table('auction')
              ->where('id', $id)
              ->update(['auction_status' => 'approved','dateapproved'=>'now()']);
    }

    private function db_remove_creation($id){
        DB::table('auction')
              ->where('id', $id)
              ->update(['auction_status' => 'removed','dateapproved' => 'now()']);
    }

    private function db_approve_modification($ida,$idm){
        DB::transaction(function() use ($ida,$idm){
          $auction = Auction::find($ida);
          $auction_modified = AuctionModification::find($idm);

          $auction_modified->dateapproved = DB::raw('now()');
          $auction_modified->is_approved = true;
          $auction_modified->save();

          $auction->description = $auction_modified->newdescription;
          $auction->save();
        });
    }

    private function db_remove_modification($idm){
        $auction_modified = AuctionModification::find($idm);

        $auction_modified->dateapproved = DB::raw('now()');
        $auction_modified->is_approved = false;
        $auction_modified->save();
    }

    public function action(Request $request){
        if ($this->isNotModerator())
          return redirect('home');

        if ($request->action=="approve_creation"){
          $this->db_approve_creation($request->ida);
          return response()->json(['success'=>'Auction creation was successfully approved.','action'=>$request->action,'requestId'=>$request->ida,'did'=>'1']);
        }

        else if ($request->action=="remove_creation"){
          $this->db_remove_creation($request->ida);
          return response()->json(['success'=>'Auction creation was successfully removed.','action'=>$request->action,'requestId'=>$request->ida,'did'=>'2']);
        }

        else if ($request->action=="approve_modification"){
          $this->db_approve_modification($request->ida,$request->idm);
          return response()->json(['success'=>'Auction modification was successfully approved.','action'=>$request->action,'requestIdModification'=>$request->idm,'did'=>'3']);
        }

        else if ($request->action=="remove_modification"){
          $this->db_remove_modification($request->idm);
          return response()->json(['success'=>'Auction modification was successfully removed.','action'=>$request->action,'requestIdModification'=>$request->idm,'did'=>'4']);
        }

        else if ($request->action="remove_auction"){
          $this->db_remove_auction($request->ida);
          return response()->json(['success'=>'Auction was successfully removed.','action'=>$request->action,'requestIdModification'=>$request->idm,'did'=>'5']);
        }

        return response()->json(['unexpected'=>'Error: unknown action stated in request.','action'=>$request->action]);
    }
}