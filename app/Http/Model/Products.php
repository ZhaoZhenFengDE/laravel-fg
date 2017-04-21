<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $table = 'commodity';
    protected $primaryKey = 'commodity_id';
    public $timestamps = false;
    protected $guarded = [];
}
