<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        if (!Auth::check()) {
            return redirect('/home');
        }

        $user = User::find($id);

        $images = DB::table('image')->where('idusers', $id)->pluck('source');
        if (sizeof($images) == 0) {
            $images = ["default.png"];
        }

        return view('pages.profile', ['user' => $user, 'image' => $images[0]]);
    }

    public function editUser(Request $request, $id)
    {
        if (Auth::user()->id != $id) {
            return redirect('/home');
        }

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

        $input = $request->all();

        if ($input['name'] !== null) {
            DB::update('update users set name = ? where id = ?', [$input['name'], $id]);
        }

        if ($input['age'] !== null) {
            DB::update('update users set age = ? where id = ?', [$input['age'], $id]);
        }

        if ($input['email'] !== null) {
            DB::update('update users set email = ? where id = ?', [$input['email'], $id]);
        }

        if ($input['address'] !== null) {
            DB::update('update users set address = ? where id = ?', [$input['address'], $id]);
        }

        if ($input['postalcode'] !== null) {
            DB::update('update users set postalCode = ? where id = ?', [$input['postalcode'], $id]);
        }

        if ($input['idcountry'] !== null) {
            DB::update('update users set idCountry = ? where id = ?', [$input['idcountry'], $id]);
        }

        if ($input['phone'] !== null) {
            DB::update('update users set phone = ? where id = ?', [$input['phone'], $id]);
        }

/*
$image = DB::table('image')->where('iduser', $id)->pluck('source')[0];
if ($image == NULL)
$image = "default.png";*/

        //TODO lol wut check tomorrow
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $name = time() . $file[0]->getClientOriginalName();
            $file[0]->move('img', $name);

            if (sizeof(DB::select('select * FROM image WHERE idusers = ?', [$id])) > 0) {
                DB::update('update image set source = ? where idusers = ?', [$name, $id]);
            } else {
                DB::insert('INSERT INTO image (source,idusers) VALUES(?,?)', [$name, $id]);
            }

        }

        return redirect()->route('profile', ['id' => Auth::user()->id]);
    }
}
