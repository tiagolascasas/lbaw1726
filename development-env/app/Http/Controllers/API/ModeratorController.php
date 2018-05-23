<?php

namespace App\Http\Controllers\API;

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

    public function approve_auction(Request $request)
    {
        if (!($request->ajax() || $request->pjax() || Auth::Check() || Auth::user()->users_status != "moderator")) {
            return response('Forbidden.', 403);
        }

        $id = $request->input('idAuction');
        if ($id !== null) {
            try {
                DB::update("UPDATE auction SET auction_status = approved WHERE id = ?", [$id]);
            } catch (QueryException $qe) {
                return response('NOT FOUND', 404);
            }
        } else {
            return response('Incorrect Request', 400);
        }

        return response('OK', 200);
    }

    public function remove_auction(Request $request)
    {
        if (!($request->ajax() || $request->pjax() /*|| Check se é admin senão lol...*/)) {
            return response('Forbidden.', 403);
        }

        $id = $request->input('idAuction');
        if ($id !== null) {
            try {
                DB::update("UPDATE auction SET auction_status = removed WHERE id = ?", [$id]);
            } catch (QueryException $qe) {
                return response('NOT FOUND', 404);
            }
        } else {
            return response('Incorrect Request', 400);
        }

        return response('OK', 200);

    }

    //TODO resto
}
