<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table = 'blog';
    protected $primaryKey = 'blog_id';
    protected $guarded = [];
}
