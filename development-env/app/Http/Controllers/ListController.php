<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
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

    public function myauctions()
    {
        if (!Auth::check()) {
            return redirect('/home');
        }

        $action = "MY_AUCTIONS";

        return view('pages.list', ['action' => $action]);
    }

    public function auctions_imIn()
    {
        if (!Auth::check()) {
            return redirect('/home');
        }
        $action = "AUCTIONS_IN";

        return view('pages.list', ['action' => $action]);
    }

    public function history()
    {
        if (!Auth::check()) {
            return redirect('/home');
        }
        $action = "HISTORY";

        return view('pages.list', ['action' => $action]);
    }

    public function wishlist()
    {
        if (!Auth::check()) {
            return redirect('/home');
        }
        $action = "WISHLIST";

        return view('pages.list', ['action' => $action]);
    }
}
