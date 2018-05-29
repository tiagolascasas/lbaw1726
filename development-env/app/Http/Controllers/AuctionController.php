<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Category;
use App\CategoryAuction;
use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuctionController extends Controller
{
    private static $lastUpdate = 0;

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
        $auction = Auction::find($id);

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

        if ($auction->dateapproved != null) {
            $timestamp = $this->createTimestamp($auction->dateapproved, $auction->duration);
        } else {
            $timestamp = "Auction hasn't been approved yet";
        }

        $images = DB::table('image')->where('idauction', $id)->pluck('source');
        if (sizeof($images) == 0) {
            $images = ["default_no_img.png"];
        }

        $query = "SELECT max(bidValue) FROM bid WHERE idAuction = ?";
        $maxBid = DB::select($query, [$id]);
        if ($maxBid[0]->max == null) {
            $maxBid[0]->max = 0.00;
        }

        if (Auth::check()) {
            $wish = DB::select("SELECT * FROM whishlist WHERE idbuyer = ? and idauction = ?", [Auth::user()->id, $auction->id]);
            if (sizeof($wish) > 0) {
                $auction->wishlisted = true;
            } else {
                $auction->wishlisted = false;
            }
        } else {
            $auction->wishlisted = false;
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

        if ($auction->idseller != Auth::user()->id) {
            return redirect('/auction/' . $id);
        }

        return view('pages.auctionEdit', ['desc' => $auction->description, 'id' => $id]);
    }

    public function submitEdit(Request $request, $id)
    {
        if ($id != Auth::user()->id) {
            return redirect('/auction/' . $id);
        }

        $modID = DB::table('auction_modification')->insertGetId(['newDescription' => $request->input('description')]);

        $input = $request->all();
        $images = array();
        if ($files = $request->file('images')) {
            $integer = 0;
            foreach ($files as $file) {
                $name = time() . (string) $integer . $file->getClientOriginalName();
                $file->move('img', $name);
                $images[] = $name;
                $integer += 1;
            }
        }

        foreach ($images as $image) {
            $saveImage = new Image;
            $saveImage->source = $image;
            $saveImage->idauctionmodification = $modID;
            $saveImage->save();
        }
    }

    public function updateAuctions()
    {
        $auctions = DB::select("SELECT id, duration, dateApproved, idSeller FROM auction WHERE auction_status = ?", ["approved"]);
        $over = [];

        foreach ($auctions as $auction) { //for each auction, if it is finished, add its id to the list
            $timestamp = AuctionController::createTimestamp($auction->dateapproved, $auction->duration);
            if ($timestamp === "Auction has ended!") {
                array_push($over, $auction->id);
            }
        }

        if (sizeof($over) == 0) {
            return;
        }

        $parameters = implode(',', $over);
        $query = "UPDATE auction SET auction_status = ?, dateFinished = ? WHERE id IN (" . $parameters . ")";
        DB::update($query, ["finished", "now()"]);

        foreach ($over as $id) {
            return $this->notifyOwner($id);
        }
    }

    public function notifyOwner($id)
    {
        $res = DB::select("SELECT id, idseller, title FROM auction WHERE id = ?", [$id]);
        $text = "Your auction of " . $res[0]->title . " has finished!";
        $notifID = DB::table('notification')->insertGetId(['information' => $text, 'idusers' => $res[0]->idseller]);
        DB::insert("INSERT INTO notification_auction (idAuction, idNotification) VALUES (?, ?)", [$res[0]->id, $notifID]);
    }

    public static function notifyWinnerAndPurchase($id)
    {
    }

    public static function notifyBidders($id)
    {
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
