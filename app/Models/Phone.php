<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
      //نكتب هذا الخطوة اذا اسم الجدول مكتوب بطريقة غير صحيحة 
     //phones  الطريقة الصحيحة او طريقة الارافيل يجب ان نكتب 
    // نكتب هذا الخطوة حتي لا نقوم بتغير اسم الجدول 
    protected $table = "phone";
    protected $fillable=['code','phone','user_id'];
    protected $hidden=['user_id'];

    public $timestamps = false;
    
      //user_id نقوم باضافتها فقط عندما يكون مكتوب بطريقة غير صحيحة
     // id طريقة الارافيل === نكتب الاسم الاول من الجدول  بعد ذلك _ ثم نكتب ال 
    // user_id === هذه الطريقة صحيحة لكن قومنا بكتبتها فقط لي توضيح   
    ################## Begin relations ############
    public function  user(){
        return $this ->  belongsTo('App\User','user_id');
    }
    ################## End relations ############
}