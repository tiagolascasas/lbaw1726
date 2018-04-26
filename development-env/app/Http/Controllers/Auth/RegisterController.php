<?php

namespace App\Http\Controllers\Auth;

use Storage;
use App\User;
use App\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'age' => 'required|min:18|integer',
            'address' => 'required|string|max:255',
            'idcountry' => 'required|integer',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
       // $file = $data['images'][0];
       // $file->move('avatars', $file->getClientOriginalName());

        $saveUser = new User;
        $saveUser->create([
            'address' => $data['address'],
            'age' => $data['age'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'postalcode' => $data['postalcode'],
            'username' => $data['username'],
            'idcountry' => $data['idcountry'],
        ]);

        //$saveImage = new Image;
        //$saveImage->source = $file->getClientOriginalName();
        //$saveImage->idusers = $saveUser->id;
        //$saveImage->save();

        return $saveUser;
    }
}
