<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name','status','created_at','updated_at'];
    protected $hidden = [
        'created_at','updated_at'
    ];
}
