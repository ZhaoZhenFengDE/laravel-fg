<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
}
