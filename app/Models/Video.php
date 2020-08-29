<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{   //migrations لا يطابق اسم الجدول اي  model  نستخدام هذا الامر اذا كان اسم  
    protected $table = "videos";

    protected $fillable = ['name' , 'viewers'];

    public $timestamps = false ;
}
