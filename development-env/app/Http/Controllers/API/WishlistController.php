<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        try {
            if (!($request->ajax() || $request->pjax() || Auth::check())) {
                return response('Forbidden.', 403);
            }
            $id = $request->input('id');

            $wish = DB::select("SELECT * FROM whishlist WHERE idbuyer = ? and idauction = ?", [Auth::user()->id, $id]);
            $response = "";

            if (sizeof($wish) > 0) {
                DB::delete("DELETE FROM whishlist WHERE idbuyer = ? and idauction = ?", [Auth::user()->id, $id]);
                $response = ['wishlisted' => false];
            } else {
                DB::insert("INSERT INTO whishlist (idbuyer, idauction) VALUES (?, ?)", [Auth::user()->id, $id]);
                $response = ['wishlisted' => true];
            }
        } catch (Exception $e) {
            $this->error($e);
            return response('Internal Error', 500);
        }
        return response()->json($response);
    }
}
