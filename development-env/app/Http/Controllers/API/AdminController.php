<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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

    public function terminate(Request $request)
    {
        if (!($request->ajax() || $request->pjax() /*|| Check se é admin senão lol...*/)) {
            return response('Forbidden.', 403);
        }

        $id = $request->input('id_member');
        if ($id !== null) {
            try {
                DB::update("UPDATE users SET users_status = terminated WHERE id = ?", [$id]);
                //TODO update requested termination
            } catch (QueryException $qe) {
                return response('NOT FOUND', 404);
            }
        } else {
            return response('Incorrect Request', 400);
        }

        return response('OK', 200);
    }

    public function ignore(Request $request)
    {
        if (!($request->ajax() || $request->pjax() /*|| Check se é admin senão lol...*/)) {
            return response('Forbidden.', 403);
        }

        $id = $request->input('id_member');
        if ($id !== null) {
            try {
                //TODO update requested termination
            } catch (QueryException $qe) {
                return response('NOT FOUND', 404);
            }
        } else {
            return response('Incorrect Request', 400);
        }

        return response('OK', 200);

    }

    public function suspend(Request $request)
    {
        if (!($request->ajax() || $request->pjax() /*|| Check se é admin senão lol...*/)) {
            return response('Forbidden.', 403);
        }

        $id = $request->input('id_member');
        if ($id !== null) {
            try {
                DB::update("UPDATE users SET users_status = suspended WHERE id = ?", [$id]);
            } catch (QueryException $qe) {
                return response('NOT FOUND', 404);
            }
        } else {
            return response('Incorrect Request', 400);
        }

        return response('OK', 200);

    }

    //tmb é chamada para revoker moderator
    public function reactivate_or_revokeModerator(Request $request)
    {
        if (!($request->ajax() || $request->pjax() /*|| Check se é admin senão lol...*/)) {
            return response('Forbidden.', 403);
        }

        $id = $request->input('id_member');
        if ($id !== null) {
            try {
                DB::update("UPDATE users SET users_status = normal WHERE id = ?", [$id]);
            } catch (QueryException $qe) {
                return response('NOT FOUND', 404);
            }
        } else {
            return response('Incorrect Request', 400);
        }

        return response('OK', 200);

    }

    public function ban(Request $request)
    {
        if (!($request->ajax() || $request->pjax() /*|| Check se é admin senão lol...*/)) {
            return response('Forbidden.', 403);
        }

        $id = $request->input('id_member');
        if ($id !== null) {
            try {
                DB::update("UPDATE users SET users_status = banned WHERE id = ?", [$id]);
            } catch (QueryException $qe) {
                return response('NOT FOUND', 404);
            }
        } else {
            return response('Incorrect Request', 400);
        }

        return response('OK', 200);

    }

    public function promote_moderator(Request $request)
    {
        if (!($request->ajax() || $request->pjax() /*|| Check se é admin senão lol...*/)) {
            return response('Forbidden.', 403);
        }

        $id = $request->input('id_member');
        if ($id !== null) {
            try {
                DB::update("UPDATE users SET users_status = moderator WHERE id = ?", [$id]);
            } catch (QueryException $qe) {
                return response('NOT FOUND', 404);
            }
        } else {
            return response('Incorrect Request', 400);
        }

        return response('OK', 200);
    }
}
