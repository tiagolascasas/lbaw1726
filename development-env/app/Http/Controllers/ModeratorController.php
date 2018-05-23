<?php

namespace App\Http\Controllers;

use App\Auction;
use App\AuctionModification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    private function isNotModerator()
    {
        if (Auth::user()->users_status != "moderator") {
            return true;
        }

    }

    public function show()
    {
        if ($this->isNotModerator()) {
            return redirect('home');
        }

        $auctions = Auction::where('auction_status', "waitingApproval")->get(); //new auctions
        $auction_modifications = AuctionModification::where('dateapproved', null)->get(); //auctions waiting mod
        $auction_modifications_ids = AuctionModification::where('dateapproved', null)->get()->pluck('idapprovedauction');
        $auctions_to_mod = Auction::whereIn('id', $auction_modifications_ids)->get(); //the auction's data of all the auctions requests for modification

        return view('pages.moderator', ['auctions' => $auctions, 'auction_modifications' => $auction_modifications, 'auctions_to_mod' => $auctions_to_mod]);
    }

    private function db_remove_auction($id)
    {
        DB::table('auction')
            ->where('id', $id)
            ->update(['auction_status' => 'removed', 'dateremoved' => 'now()']);
    }

    private function db_restore_auction($id)
    {
        DB::table('auction')
            ->where('id', $id)
            ->update(['auction_status' => 'approved', 'dateremoved' => null]);
    }

    /**
     *
     * Aprove a new auction
     *
     */
    private function db_approve_creation($id)
    {
        DB::table('auction')
            ->where('id', $id)
            ->update(['auction_status' => 'approved', 'dateapproved' => 'now()']);
    }

    private function db_remove_creation($id)
    {
        DB::table('auction')
            ->where('id', $id)
            ->update(['auction_status' => 'removed', 'dateapproved' => 'now()']);
    }

    private function db_approve_modification($ida, $idm)
    {
        DB::transaction(function () use ($ida, $idm) {
            $auction = Auction::find($ida);
            $auction_modified = AuctionModification::find($idm);

            $auction_modified->dateapproved = DB::raw('now()');
            $auction_modified->is_approved = true;
            $auction_modified->save();

            $auction->description = $auction_modified->newdescription;
            $auction->save();
        });
    }

    private function db_remove_modification($idm)
    {
        $auction_modified = AuctionModification::find($idm);

        $auction_modified->dateapproved = DB::raw('now()');
        $auction_modified->is_approved = false;
        $auction_modified->save();
    }

    private function db_get_new_description($ida, $idm)
    {
        $auction = Auction::find($ida);

        $description = array(
            "new" => AuctionModification::find($idm)->newdescription,
            "old" => $auction->description,
            "title" => $auction->title,
        );

        $auction_modified = AuctionModification::find($idm);
        $newdescription = $auction_modified->newdescription;
        return json_encode($description);
    }

    private function approve_creation($request)
    {
        $this->db_approve_creation($request->ida);
        return response()->json(['success' => 'Auction creation was successfully approved.', 'action' => $request->action, 'requestId' => $request->ida, 'did' => '1']);
    }

    private function remove_creation($request)
    {
        $this->db_remove_creation($request->ida);
        return response()->json(['success' => 'Auction creation was successfully removed.', 'action' => $request->action, 'requestId' => $request->ida, 'did' => '2']);
    }

    private function approve_modification($request)
    {
        $this->db_approve_modification($request->ida, $request->idm);
        return response()->json(['success' => 'Auction modification was successfully approved.', 'action' => $request->action, 'requestIdModification' => $request->idm, 'did' => '3']);
    }

    private function remove_modification($request)
    {
        $this->db_remove_modification($request->idm);
        return response()->json(['success' => 'Auction modification was successfully removed.', 'action' => $request->action, 'requestIdModification' => $request->idm, 'did' => '4']);
    }

    private function restore_auction($request)
    {
        $this->db_restore_auction($request->ida);
        return response()->json(['success' => 'Auction was successfully restored.', 'action' => $request->action, 'requestIdModification' => $request->idm, 'did' => '6']);
    }

    private function remove_auction($request)
    {
        $this->db_remove_auction($request->ida);
        return response()->json(['success' => 'Auction was successfully removed.', 'action' => $request->action, 'requestIdModification' => $request->idm, 'did' => '5']);
    }

    private function get_new_description($request)
    {
        return $this->db_get_new_description($request->ida, $request->idm);
    }

    private function unkown_action($request)
    {
        return response()->json(['unexpected' => 'Error: unknown action stated in request.', 'action' => $request->action]);
    }

    public function action(Request $request)
    {
        if ($this->isNotModerator()) {
            return redirect('home');
        }

        $action = $request->action;

        if ($action === "approve_creation") {
            return $this->approve_creation($request);
        }

        if ($action === "remove_creation") {
            return $this->remove_creation($request);
        }

        if ($action === "approve_modification") {
            return $this->approve_modification($request);
        }

        if ($action === "remove_modification") {
            return $this->remove_modification($request);
        }

        if ($action === "restore_auction") {
            return $this->restore_auction($request);
        }

        if ($action === "remove_auction") {
            return $this->remove_auction($request);
        }

        if ($action === "get_new_description") {
            return $this->get_new_description($request);
        }

        //Unkown action error
        return $this->unkown_action($request);
    }
}
