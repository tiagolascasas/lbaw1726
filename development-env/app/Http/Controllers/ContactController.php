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

use Mailgun\Mailgun;
use GuzzleHttp\Client;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ContactController extends Controller
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
    public function show(Request $request)
    {
        return view('pages.contact');
    }

        /**
     * Shows the auction for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function message(Request $request)
    {

        //ip and user agent information
        $ip = $request->ip();
        $ua = $request->header('User-Agent');

        //mailgun init
        $client = new Client([
            'base_uri' => 'https://api.mailgun.net/v3',
            'verify' => false
        ]);
        $adapter = new \Http\Adapter\Guzzle6\Client($client);
        $domain = "sandboxeb3d0437da8c4b4f8d5a428ed93f64cc.mailgun.org";
        $mailgun = new \Mailgun\Mailgun('key-44a6c35045fe3c3add9fcf0a018e654e', $adapter);

        # Send the email 
        $result = $mailgun->sendMessage("$domain",
                  array('from'    => 'Home remote Sandbox <postmaster@sandboxeb3d0437da8c4b4f8d5a428ed93f64cc.mailgun.org>',
                        'to'      => 'Daniel Azevedo <daniel.azevedo@fe.up.pt>',
                        'subject' => 'Contact message',
                        'text'    => 'Someone droped a contact message using the contact page.
                        '.'IP: '.$ip.'
                        User Agent: '.$ua.'
                        Name: '.$request->input('name').'
                        E-mail: '.$request->input('email').'
                        Message: '.$request->input('message'),
                        'require_tls'       => 'false',
                        'skip_verification' => 'true'
                        ));

        return view('pages.contact');
    }

}
