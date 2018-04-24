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
use App\Country;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
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
     * Shows the User profile for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if (!Auth::check()) return redirect('/home');

        $user = User::find($id);

        return view('pages.profile', ['user' => $user]);
    }



    public function editUser(Request $request, $id)
    {
        if (Auth::user()->id!=$id) return redirect('/home');

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'age' => 'nullable|min:18|integer',
            'address' => 'nullable|string|max:255',
            'idcountry' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->route('profile', ['id' => Auth::user()->id])
                        ->withErrors($validator)
                        ->withInput();
        }

        $input =$request->all();

        if($input['name']!==NULL)
            DB::update('update users set name = ? where id = ?', [$input['name'],$id]);
        if($input['age']!==NULL)
            DB::update('update users set age = ? where id = ?', [$input['age'],$id]);
        if($input['email']!==NULL)
            DB::update('update users set email = ? where id = ?', [$input['email'],$id]);
        if($input['address']!==NULL)
            DB::update('update users set address = ? where id = ?', [$input['address'],$id]);
        if($input['postalcode']!==NULL)
            DB::update('update users set postalCode = ? where id = ?', [$input['postalcode'],$id]);
        if($input['idcountry']!==NULL)
            DB::update('update users set idCountry = ? where id = ?', [$input['idcountry'],$id]);
        if($input['phone']!==NULL)
            DB::update('update users set phone = ? where id = ?', [$input['phone'],$id]);

        return redirect()->route('profile', ['id' => Auth::user()->id]);
    }
}
