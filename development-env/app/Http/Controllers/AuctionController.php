<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Auction;
use App\Category;
use App\CategoryAuction;
use App\Member;
use App\Bid;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuctionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */




        /**
         * Creates a new card.
         *
         * @return Card The card created.
         */
        public function create(Request $request)
        {
          $aution = new Auction();
          //create category
          //create publisher
          //create bid

          // $this->authorize('create', $auction);

          // $auction->user_id = Auth::user()->id;
          $auction->user_id = 1; //change to up line after auth is ready

          $auction->title = $request->input('title');
          $auction->author = $request->input('author');
          $auction->description = $request->input('description');
          $auction->duration = $request->input('duration');
          $auction->isbn = $request->input('isbn');

          $auction->save();
          //save category
          //save publisher
          //save bid


          return $auction;
        }

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
     * Shows the card for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      // if (!Auth::check()) return redirect('/home');

      $auction = Auction::find($id);

      // $this->authorize('show', $card);


      return view('pages.auction', ['auction' => $auction]);
    }
}
