<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'age', 'email', 'password','phone','postalcode','username','idcountry',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     *
     * This user's country
     *
     */
    public function country(){
        return $this->hasOne('App\Country','id','idcountry');
    }

    /**
     *
     * This user's auctions
     *
     */
    public function auctions(){
       return $this->hasMany('App\Auction','id','idseller');
    }


    /**
     *
     * This user's bids
     *
     */
    public function bids(){
       return $this->hasMany('App\Bid','id','idbuyer');
    }
}
