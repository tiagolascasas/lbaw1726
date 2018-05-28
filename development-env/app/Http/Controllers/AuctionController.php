<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Category;
use App\CategoryAuction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        if ($categoryNumber != null) {
            $categoryName = Category::where('id', $categoryNumber->idcategory)->get()->first();
            if ($categoryName != null) {
                $categoryName = $categoryName->categoryname;
            } else {
                $categoryName = "No category";
            }
        } else {
            $categoryName = "No category";
        }

        //calculate the remaining time
        if ($auction->dateapproved != null) {
            $timestamp = $this->createTimestamp($auction->dateapproved, $auction->duration);
        } else {
            $timestamp = "Auction hasn't been approved yet";
        }

        //get the images, or the default image if there are no images
        $images = DB::table('image')->where('idauction', $id)->pluck('source');
        if (sizeof($images) == 0) {
            $images = ["default_no_img.png"];
        }

        //get the current max bid
        $query = "SELECT max(bidValue) FROM bid WHERE idAuction = ?";
        $maxBid = DB::select($query, [$id]);
        if ($maxBid[0]->max == null) {
            $maxBid[0]->max = 0.00;
        }

        return view('pages.auction', ['auction' => $auction,
            'categoryName' => $categoryName,
            'images' => $images,
            'maxBid' => $maxBid[0]->max,
            'timestamp' => $timestamp]);
    }

    public function edit($id)
    {
        $auction = Auction::find($id);

        if ($auction->idseller != Auth::user()->id)
        {
            return redirect('/auction/' . $id);
        }

        return view('pages.auctionEdit', ['desc' => $auction->description, 'id' => $id]);
    }

    public function submitEdit(Request $request, $id)
    {

        return show($id);
    }

    public static function createTimestamp($dateApproved, $duration)
    {
        $start = strtotime($dateApproved);
        $duration = $duration;
        $end = $start + $duration;
        $current = time();
        $time = $end - $current;

        if ($time <= 0) {
            return "Auction has ended!";
        }

        $ts = "";
        $ts .= intdiv($time, 86400) . "d ";
        $time = $time % 86400;
        $ts .= intdiv($time, 3600) . "h ";
        $time = $time % 3600;
        $ts .= intdiv($time, 60) . "m ";
        $ts .= $time % 60 . "s";

        if (strpos($ts, "0d ") !== false) {
            $ts = str_replace("0d ", "", $ts);
            if (strpos($ts, "0h ") !== false) {
                $ts = str_replace("0h ", "", $ts);
                if (strpos($ts, "0m ") !== false) {
                    $ts = str_replace("0m ", "", $ts);
                    if (strpos($ts, "0s") !== false) {
                        $ts = "Auction has ended!";
                    }

                }
            }
        }
        return $ts;
    }
}
