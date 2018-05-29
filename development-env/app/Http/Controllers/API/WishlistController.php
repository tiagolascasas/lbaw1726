<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\API\BidController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
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

    public function wish(Request $request)
    {
        if (!($request->ajax() || $request->pjax() || Auth::check())) {
            return response('Forbidden.', 403);
        }
        $id = $request->input('id');

        $wish = DB::select("SELECT * FROM whishlist WHERE idbuyer = ? and idauction = ?", [Auth::user()->id, $id]);
        $response = "";

        if (sizeof($wish) > 0) {
            error_log("del");
            DB::delete("DELETE FROM whishlist WHERE idbuyer = ? and idauction = ?", [Auth::user()->id, $id]);
            $response = ['wishlisted' => false ];
        } else {
            DB::insert("INSERT INTO whishlist (idbuyer, idauction) VALUES (?, ?)", [Auth::user()->id, $id]);
            error_log("ok");
            $response = ['wishlisted' => true ];
        }
        return response()->json($response);
    }
}
