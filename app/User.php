<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// implements ==> الأدوات
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile' , 'expire' , 'age' ,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

      //user_id نقوم بايضافتها فقط عندما يكون مكتوب بطريقة غير صحيحة
     // id طريقة الارافيل === نكتب الاسم الاول من الجدول  بعد ذلك _ ثم نكتب ال 
    // user_id === هذه الطريقة صحيحة لكن قومنا بكتبتها فقط لي توضيح   
    ################## Begin relations ############
    public function  phone(){
        return $this ->  hasOne('App\Models\Phone','user_id');
    }
    ################## End relations ############
}
