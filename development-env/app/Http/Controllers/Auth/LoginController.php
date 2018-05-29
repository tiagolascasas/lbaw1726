<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }



    protected function authenticated(Request $request, User $user){
        //put your thing in here
        if ($user->isNormal()){
            return redirect()->route('home');    
        }
        else if ($user->isModerator() || $user->isAdmin()){
            return redirect()->route('home');
        }
        else if ($user->isSuspended()){
            Auth::logout();
            return redirect()->route('contact')->withErrors("Your account has been suspended. Contact the admin through the contact page for details."); 
        } 
        else if ($user->isBanned()){
            Auth::logout();
            return redirect()->route('contact')->withErrors("You are permanently banned. Contact the admin through contact page for details."); 
        }
        else if ($user->isTerminated()){
            Auth::logout();
            return redirect()->route('contact')->withErrors("Your account has been terminated. Contact the admin through contact page for details."); 
        }
    }
}
