<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Http\Controllers\Controller;

class AboutController extends Controller
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
    public function show()
    {

        return view('pages.about');
    }
}
