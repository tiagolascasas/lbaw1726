<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
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

    public function index(Request $request)
    {
        if ( !($request->ajax() || $request->pjax()))
        {
            return response('Forbidden.', 403);
        }

        $parameters = [];
        $query = "select id, title,  ";

        if ($request->input('keywords') != null)
        {

        }
        if ($request->input('title') != null)
        {
            $query .= "and title @@ plainto_tsquery('english',?) ";
            array_push($parameters, $request->input('title'));
        }
        if ($request->input('publisher') != null)
        {

        }
        if ($request->input('author') != null)
        {

        }
        if ($request->input('isbn') != null)
        {

        }
        if ($request->input('language') != null)
        {

        }
        if ($request->input('category') != null)
        {

        }
        if ($request->input('isApproved') != null)
        {

        }
        if ($request->input('isEnded') != null)
        {

        }
        if ($request->input('maxBid') != null)
        {

        }
        if ($request->input('profile_search') != null)
        {

        }
        if ($request->input('idMember') != null)
        {

        }/*
        if ($request->input('notLoad') != null)
        {
            for ($id in $request->input('notLoad'))
            {
                $query .= "and auction.id != ?";
                array_push($parameters, $id);
            }
        }*/


        $query .= "limit 12";
        //array_push($parameters, $request->input('limit'));

        $response = DB::select($query, $parameters);
        return response()->json($response);
    }
}
