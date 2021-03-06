<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{ //migrations لا يطابق اسم الجدول اي  model  نستخدام هذا الامر اذا كان اسم  
    protected $table = "offers";
  // fillable ==> insert يقوم بي اظهار هذه العناصر عندما نكتب ال 
  // fillable ==>   هذه العناصر  المسموح التعامل مع قاعدة البيانات 
  // عندما نريد التعامل مع اي من هذه العناصر الموجود في قاعدة لا تستطيع 
  //fillable التعامل معها اذا لم تكون موجود في ال 
    protected $fillable = ['name_ar' , 'name_en' , 'photo' , 'price' , 'details_ar' , 'details_en' , 'status' , 'created_at' , 'updated_at'] ;

 //  hidden عكس fillable 
    protected $hidden   = ['created_at' , 'updated_at'] ;

  // databace الي قاعدة البيانات  created_at و updated_at  هذا الامر اذا كن لا نريد اضافة ال 
  // public $timestamps = false ;

  ########################## Local Scopes ####################################
  public function scopeInactive($query){

     return  $query -> where('status' , '=' , 0);
  }
  
  public function scopeInvalid($query){

    return  $query -> where('status' , '=' , 0)->whereNull('details_ar');
  ########################## Local Scopes ####################################
 }
}
