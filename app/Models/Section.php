<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name','status','created_at','updated_at'];
    protected $hidden = [
        'created_at','updated_at'
    ];
    public $timestamps = true;


    public function categories(){
        return $this ->hasMany('App\Models\Category','section_id')->where(['parent_id' =>0,'status'=>1])
        ->with('subcategories');
    }
}
