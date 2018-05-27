<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Comment;

class CommentController extends Controller
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

    public function getComments(Request $request)
    {
        if (!($request->ajax() || $request->pjax()) || !Auth::check()) {
            return response('Forbidden.', 403);
        }
        $id = $request->input('user');
        if($id !== null){
            try{
                $response = DB::select('SELECT comment.id, comment.datePosted,comment.liked,comment.idsender,comment.comment_text,users.username
                                FROM comment,users
                                WHERE comment.idreceiver=?
                                AND users.id = comment.idSender', [$id]);
            }catch (QueryException $qe) {
                return response('NOT FOUND', 404);
            }
        }else {
            return response('Incorrect Request', 400);
        }


        return response()->json($response);
    }
}

