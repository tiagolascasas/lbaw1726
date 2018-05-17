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

    public function show()
    {
        $auctions = [];
        $responseSentence = "Use the advanced search options above to find auctions";

        return view('pages.search', ['auctions' => $auctions, 'responseSentence' => $responseSentence]);
    }

    public function simpleSearch(Request $request)
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

        try{
            $input = $request->all();
            $searchTerm = $input['searchTerm'];
            $category = $input['category'];

        //FOR TESTING ONLY
            $query = 'select distinct on (auction.id) * from auction, category_auction, category where auction_status = ? ';
            $parameters = ['waitingApproval'];
        //USE THIS ON THE END
        //$query = 'select distinct on (auction.id) * from auction, image, category_auction, category where auction_status = ? and auction.id = image.idAuction ';
        //$parameters = ['approved'];
            $responseSentence = [];

            if ($searchTerm != null)
            {
              $query .= 'and title = ? ';
                array_push($parameters, $searchTerm);
                array_push($responseSentence, ' with title "' . $searchTerm . '"');
            }
            if ($category !== 'All')
            {
                $query .= 'and category_auction.idAuction = auction.id and category_auction.idCategory = category.id and categoryName = ? ';
                array_push($parameters, $category);
                array_push($responseSentence, 'in category ' . $category);
            }
            else
            {
                array_push($responseSentence, 'in any category');
            }
            $query .= 'limit 12';

            $responseSentence = implode(' and ', $responseSentence);
            $responseSentence = 'Your search results for auctions ' . $responseSentence . ':';

            $auctions = DB::select($query, $parameters);

        } catch(QueryException $qe) {
            $errors = new MessageBag();
    
            $errors->add('An error ocurred', "There was a problem searching for auctions. Try Again!");
    
            return redirect()
            ->route('search')
            ->withErrors($errors);
         }

        return view('pages.search', ['auctions' => $auctions, 'responseSentence' => $responseSentence]);
    }
}
