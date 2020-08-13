<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUserName() {

        return 'Dilshad Abdulazim' ;
    }

    public function getIndex(){

        // $data = [] ;
        // $data['id'] = 10 ;
        // $data['name'] = 'dilshad abdulazim' ;

        // return view('welcome1' , $data) ;

        $obj = new \stdClass();
        $obj->id = 11 ;
        $obj->name = 'mostafa dilshad ' ;

        return view('welcome1' , compact('obj'));

    }

}
