<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    protected $guarded = [];
    public $timestamps = false;
    public function tree()
    {
        $categories = $this->orderBy('cate_order','asc')->get();
        return $this->getTree($categories,'cate_id','cate_name','cid');
    }
//    public static function tree()
//    {
//        $categories = Category::all();
//        return (new Category)->getTree($categories,'cate_id','cate_name','cid');
//    }

    public function getTree($data,$filed_id='id',$filed_name,$filed_cid='cid',$cid=0)
    {
        $arr = array();
        foreach($data as $k=>$v){
            if($v->$filed_cid === $cid){
                $data[$k]['_'.$filed_name] = $data[$k][$filed_name];
                $arr[] = $data[$k];
                foreach($data as $m=>$n){
                    if($n->$filed_cid === $v->$filed_id){
                        $data[$m]['_cate_name'] = '=> '.$data[$m]['cate_name'];
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }
}
