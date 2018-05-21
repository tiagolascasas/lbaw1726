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

    private function get_duplicates($array)
    {
        return array_unique(array_diff_assoc($array, array_unique($array)));
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

        $input = $request->all();
        $searchTerm = $input['searchTerm'];
        $category = $input['category'];
        $approved = "approved";
        $responseSentence = [];
        $ids = [];
        $debug = "DEBUG: ";
        $auctions = [];

        try
        {
            //get ids of auctions with
            if ($searchTerm != null)
            {
                $res = DB::select("SELECT auction.id FROM auction WHERE title @@ plainto_tsquery('english',?) and auction_status = ?", [$searchTerm, $approved]);
                foreach ($res as $entry)
                    array_push($ids, $entry->id);

                array_push($responseSentence, ' with title "' . $searchTerm . '"');
            }
            if ($category !== 'All')
            {
                $res = DB::select('SELECT auction.id FROM auction, category_auction, category WHERE category_auction.idAuction = auction.id and category_auction.idCategory = category.id and categoryName = ? and auction_status = ?', [$category, $approved]);
                foreach ($res as $entry)
                    array_push($ids, $entry->id);

                array_push($responseSentence, 'in category ' . $category);
            }
            else
            {
                $res = DB::select("SELECT id FROM auction WHERE auction_status = ?", [$approved]);
                foreach ($res as $entry)
                    array_push($ids, $entry->id);

                array_push($responseSentence, 'in any category');
            }

            //$ids = $this->get_duplicates($ids);

            $parameters = implode(",", $ids);
            $debug .= $parameters;

            $query = "SELECT id, title, author FROM auction WHERE id IN (" . $parameters . ")";
            $auctions = DB::select($query, []);

            $responseSentence = implode(' and ', $responseSentence);
            $responseSentence = 'Your search results for auctions ' . $responseSentence . ':';
        }
        catch(QueryException $qe)
        {
            $errors = new MessageBag();

            $errors->add('An error ocurred', "There was a problem searching for auctions. Try Again!");

            return redirect()
            ->route('search')
            ->withErrors($errors);
        }

        return view('pages.search', ['auctions' => $auctions, 'responseSentence' => $responseSentence]);
    }
}
