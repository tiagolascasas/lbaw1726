<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;

use App\Auction;

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

    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'searchTerm' => 'nullable|string',
            //category
        ]);

        if ($validator->fails())
        {
            return redirect()
                        ->route('home')
                        ->withErrors($validator)
                        ->withInput();
        }

        $input = $request->all();
        $searchTerm = $input['searchTerm'];
        //$category = $input['category'];

        $auctions = DB::select('select distinct * from auction, image where auction_status = ? and title = ? and auction.id = image.idAuction limit 12',['approved', $searchTerm]);

        return view('pages.search', ['auctions' => $auctions]);
    }
}
