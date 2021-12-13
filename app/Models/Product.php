<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function section(){
        return $this->belongsTo('App\Models\Section','section_id');
    }

    public function attributes(){
        return $this->hasMany('App\Models\Products_Attribute','product_id');
    }
    public function images(){
        return $this->hasMany('App\Models\Products_Image','product_id');
    }
    public function brand(){
        return $this->belongsTo('App\Models\Brand','brand_id');
    }
}
