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
            'category' => 'nullable|string',
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
        $category = $input['category'];

        $query = 'select distinct * from auction, image, category_auction, category where auction_status = ? and auction.id = image.idAuction ';
        $parameters = ['waitingApproval'];

        if ($searchTerm != null)
        {
            $query .= 'and title = ? ';
            array_push($parameters, $searchTerm);
        }
        if ($category !== 'All')
        {
            $query .= 'and category_auction.idAuction = auction.id and category_auction.idCategory = category.id and categoryName = ? ';
            array_push($parameters, $category);
        }
        $query .= 'limit 12';

        $auctions = DB::select($query, $parameters);

        return view('pages.search', ['auctions' => $auctions]);
    }
}
