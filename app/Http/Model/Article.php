<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table = 'news';
    protected $primaryKey = 'new_id';
    protected $guarded = [];
}
