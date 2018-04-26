<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryAuction extends Model
{

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category_auction';

    protected $primaryKey = 'idauction';
}
