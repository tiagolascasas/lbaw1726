<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Auction;
use App\Category;
use App\CategoryAuction;
use App\User;
use App\Bid;
use App\Image;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuctionController extends Controller
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

    /**
     * Shows the auction for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //get the full auction information
        $auction = Auction::find($id);

        //get the category number and the category name
        $categoryNumber = CategoryAuction::where('idauction', $auction->id)->get()->first();
        if ($categoryNumber!=NULL){
            $categoryName = Category::where('id', $categoryNumber->idcategory )->get()->first();
            if ($categoryName != NULL){
              $categoryName = $categoryName->categoryname;
            }
            else {
              $categoryName = "No category";
            }
        }
        else {
          $categoryName = "No category";
        }

        //get the images
        $images = DB::table('image')->where('idauction', $id)->pluck('source');

        //get the current max bid
        $query = "SELECT max(bidValue) FROM bid WHERE idAuction = ?";
        $maxBid = DB::select($query, [$id]);

        return view('pages.auction', ['auction' => $auction,
                                        'categoryName' => $categoryName,
                                        'images' => $images,
                                        'maxBid' => $maxBid[0]->max]);
    }
}
