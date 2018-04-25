<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Auction;
use App\Category;
use App\CategoryAuction;
use App\Language;
use App\Publisher;
use App\Image;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class CreateAuctionController extends Controller
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
      if (!Auth::check()) return redirect('/home');
      return view('pages.create');
    }


    /**
     * Creates a new auction.
     *
     * @return Auction The auction created.
     */
    public function create(Request $request)
    {
      if (!Auth::check()) return redirect('/home');
      // $this->authorize('create', $auction);

      $saveAuction = new Auction;
      $saveCategoryAuction = new CategoryAuction;

      $saveAuction->idseller = Auth::user()->id;

      $savePublisher = Publisher::where('publishername', $request->input('publisher'))->get()->first();

      if ($savePublisher==NULL){
        $savePublisher = new Publisher;
        $savePublisher->publishername = $request->input('publisher');
        $savePublisher->save();
        $savePublisher = $savePublisher->id;
      } else{
        $savePublisher = $savePublisher->id;
      }

      $saveCategory = Category::where('categoryname', $request->input('category'))->get()->first();

      $saveAuction->idpublisher = $savePublisher;

      $saveAuction->idlanguage = Language::where('languagename', $request->input('language'))->get()->first()->id;

      $saveAuction->title = $request->input('title');
      $saveAuction->author = $request->input('author');
      $saveAuction->description = $request->input('description');
      $saveAuction->duration = $request->input('duration');
      $saveAuction->isbn = $request->input('isbn');

      $saveAuction->save();

      if ($saveCategory!=NULL){
        $saveCategoryAuction->idcategory = $saveCategory->id;
        $saveCategoryAuction->idauction = $saveAuction->id;
        $saveCategoryAuction->save();
      }

      /*Get images and store them*/
      $input=$request->all();
      $images = array();
      if($files=$request->file('images')){
        foreach($files as $file){
            $name=$file->getClientOriginalName();
            $file->move('img',$name);
            $images[]=$name;
        }
      }

      /*Store image sources in database*/
      foreach ($images as $image){
          $saveImage = new Image;
          $saveImage->source = $image;
          $saveImage->idauction = $saveAuction->id;
          $saveImage->save();
      }


      //$saveImage->source = $request->input('filename');
      //$saveImage->idusers = $saveAuction->id;

      return redirect()->route('auction',['id' => $saveAuction->id]);
    }
}
