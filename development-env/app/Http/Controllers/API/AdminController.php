<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if (!($request->ajax() || $request->pjax()) || !Auth::Check() || Auth::user()->users_status != 'admin') {
            return response('Forbidden.', 403);
        }

        $id = $request->input('id_member');
        if ($id !== null) {
            try {
                DB::update("UPDATE users SET users_status = terminated WHERE id = ?", [$id]);
                DB::delete('DELETE FROM requested_termination WHERE idusers=?', [$id]);
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
        if (!($request->ajax() || $request->pjax()) || !Auth::Check() || Auth::user()->users_status != 'admin') {
            return response('Forbidden.', 403);
        }

        $id = $request->input('id_member');
        if ($id !== null) {
            try {
                DB::delete('DELETE FROM requested_termination WHERE idusers=?', [$id]);
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
        if (!($request->ajax() || $request->pjax()) || !Auth::Check() || Auth::user()->users_status != 'admin') {
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
        if (!($request->ajax() || $request->pjax()) || !Auth::Check() || Auth::user()->users_status != 'admin') {
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
        if (!($request->ajax() || $request->pjax()) || !Auth::Check() || Auth::user()->users_status != 'admin') {
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
        if (!($request->ajax() || $request->pjax()) || !Auth::Check() || Auth::user()->users_status != 'admin') {
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

    public function action(Request $request)
    {



        //get id from username if it's not defined
        if ($request->id_member==-1){
            $user=User::where('username',$request->username)->limit(1)->get()->first();
            if (isset($user->id))
                $request->merge(['id_member' => $user->id]);
            else
                return "Error: Username doesn't exist";   //if can't find username or it's null in the requested action
        }

        $action = $request->action;

        if ($action === "remove_profile") {
            return $this->terminate($request);
        }

        if ($action === "ignore_del_request") {
            return $this->ignore($request);
        }

        if ($action === "suspend") {
            return $this->suspend($request);
        }

        if ($action === "normal") {
            return $this->reactivate_or_revokeModerator($request);
        }

        if ($action === "ban") {
            return $this->ban($request);
        }

        if ($action === "promote") {
            return $this->promote_moderator($request);
        }

        //Unkown action error
        return $this->unkown_action($request);
    }
}