<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($service)
    { //  $service ==> facebook
          // الذي اسمه فيس بوكdriver هذه الدالة سوف تاخذنا الي  ال 
          //  كيف يعرف اسمها فيس بوك نحن قومنا بي اضافة الريط في ال register.blade.php
          // <a href="{{url('redirect/facebook')}}">Login With FaceBook</a>
       return Socialite::driver($service)->redirect();
    }

    public function callback($service)
    { // هذه الدالة تقوم بي ارجعنا الي الموقع بعد ان تاخذ المعلومات المطلوب لي التسجل
     //  في الموقع من الفيس بوك 
     
       return $user = Socialite::with($service)->user();
    }
}
