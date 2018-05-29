<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
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

    public function getNotifications(Request $request)
    {
        try {
            if (!($request->ajax() || $request->pjax()) || !Auth::check()) {
                return response('Forbidden.', 403);
            }

            $response = DB::select('SELECT notification.id, notification.information,notification.dateSent, notification_auction.idAuction, auction.title
                                FROM notification, notification_auction, auction
                                WHERE notification.is_seen=FALSE
                                AND notification.idusers=?
                                AND notification_auction.idNotification=notification.id
                                AND notification_auction.idAuction=auction.id', [Auth::user()->id]);
        } catch (Exception $e) {
            return response('Internal Error', 500);
        }
        return response()->json($response);
    }

    public function markAsSeen(Request $request)
    {
        try {
            if (!($request->ajax() || $request->pjax()) || !Auth::check()) {
                return response('Forbidden.', 403);
            }

            $id = $request->input('notification_id');
            if ($id !== null) {
                try {
                    DB::update("UPDATE notification SET is_seen = TRUE WHERE idusers = ? AND id=?", [Auth::user()->id, $id]);
                } catch (QueryException $qe) {
                    return response('NOT FOUND', 404);
                }
            } else {
                return response('Incorrect Request', 400);
            }
        } catch (Exception $e) {
            return response('Internal Error', 500);
        }

        return response('OK', 200);
    }
}
