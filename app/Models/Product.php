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
}
