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
                $response = DB::select('SELECT comment.id, comment.datePosted,comment.liked,comment.idsender,comment.comment_text,comment.idreceiver,comment.idparent,users.username
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

    public function postComment(Request $request){
        if (!($request->ajax() || $request->pjax()) || !Auth::check()) {
            return response('Forbidden.', 403);
        }
        $text = $request->input('text');
        $sender = $request->input('id_sender');
        $receiver = $request->input('id_receiver');
        $like = $request->input('liked');
        $id_parent = $request->input('id_parent');


        if ($text !== null && $sender !== null && $receiver !== null){
            try{
                DB::insert("INSERT INTO comment (liked, idreceiver,idsender,comment_text,idparent) VALUES (?,?,?,?,?)",[$like, $receiver,$sender,$text,$id_parent]);
                $message = "Successfully registered your feedback.";
                $success = true;
            }catch (QueryException $qe) {
                return response('NOT FOUND', 404);
            }
        } else {
            return response('Incorrect Request', 400);
        }
        return response()->json(['success' => $success, 'message' => $text]);
    }
}

