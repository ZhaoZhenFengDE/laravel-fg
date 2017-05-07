<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $table = 'cart';
    protected $primaryKey = 'user_id';
    protected $guarded = [];
    public $timestamps = false;
}
