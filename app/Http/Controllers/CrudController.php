<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;

class CrudController extends Controller
{
    public function getOffers()
    {   // اجلب لي جميع الاعمدة 
        return Offer::select('id' , 'name')->get();
    }

    // public function store(){

    //     Offer::create([
    //         'name' => 'Offer3',
    //         'price' => '500',
    //         'details' => 'Offer3 details' ,
    //     ]);
    // }


    public function create(){

        return view('offers.create');
    }

    public function store(OfferRequest $request){

        // validate data before insert to database
        // $rules = $this -> getRules() ;
        // $messages = $this -> getMessages();
        // $validator = Validator::make($request->all() , $rules ,  $messages);

        // if($validator -> fails()){
        //     return  redirect()->back()->withErrors($validator) -> withInput($request->all());
        // }

        // insert 
        Offer::create([
            'name_ar' => $request-> name_ar ,
            'name_en' => $request-> name_en ,
            'price' => $request-> price ,
            'details_ar' => $request-> details_ar ,
            'details_en' => $request-> details_en ,
        ]);

        return  redirect()->back()->with(['success' => 'تم اضافة العرض بنجاح']);
    }

    // protected function getMessages(){

    //     return $messages = [
    //         'name.required' =>  __('messages.offer name required')  ,
    //         'name.unique'    => __('messages.offer name unique')     ,
    //         'price.required'  => __('messages.offer price required')  ,
    //         'price.numeric'    => __('messages.offer price numeric')   ,
    //         'details.required'  => __('messages.offer details required') ,
    //     ];
    // }

    // protected function getRules(){

    //     return $rules = [
    //         'name' => 'required|max:100|unique:offers,name' ,
    //         'price'  => 'required|numeric' ,
    //         'details'  => 'required' ,
    //     ]; 
    // }

    public function getAllOffers()
    { // $offers == return collection 
       $offers = Offer::select(
                          'id' , 
                          'price' , 
                          'name_'.LaravelLocalization::getCurrentLocale().' as name' ,
                          'details_'.LaravelLocalization::getCurrentLocale().' as details' ,
                                 ) -> get();

       return view('offers.all' , compact('offers'));
    }
   
}
