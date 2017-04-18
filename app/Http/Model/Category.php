<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'blog';
    protected $primaryKey = 'blog_id';
    public $timestamps = false;
}
