<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   protected $table = 'categoreies';
   protected $fillable = ['parent_id','section_id','category_name','category_image','category_discount','status',
   'category_discount','url','meta_title','meta_description','meta_keywords','created_at','updated_at'];
   protected $hidden = [
        'created_at', 'updated_at',
   ];
   public $timestamps = true;

}
