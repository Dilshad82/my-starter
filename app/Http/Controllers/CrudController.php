<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use LaravelLocalization;
use App\Traits \OfferTrait;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    use OfferTrait ;

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


         // save photo in folder ==> public\images\offers حفظ الصورة في الفولدر
        // saveImage => Traits/OfferTrait هذا الدالة موجود في فولدر خارح الكونترول نستداعها عندما نحتاج
        $file_name = $this -> saveImage($request -> photo , 'images/offers');

        // insert 
        Offer::create([
            'photo' => $file_name ,
            'name_ar' => $request-> name_ar ,
            'name_en' => $request-> name_en ,
            'price' => $request-> price ,
            'details_ar' => $request-> details_ar ,
            'details_en' => $request-> details_en ,
        ]);

        return  redirect()->route('offers.all')->with(['success' => 'تم اضافة العرض بنجاح']);
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
                          'id'    , 
                          'price' , 
                          'photo' ,
                          'name_'.LaravelLocalization::getCurrentLocale().' as name' ,
                          'details_'.LaravelLocalization::getCurrentLocale().' as details' ,
                                 ) -> get();

       return view('offers.all' , compact('offers'));
    }

    public function editOffer($offer_id){

        //Offer::findOrFail($offer_id) ;

        $offer = Offer::find($offer_id) ; // search in given table id only 
        if(!$offer)
            return redirect() ->back();
        
        $offer = Offer::select('id', 'name_ar', 'name_en', 'details_ar', 'details_en', 'price')->find($offer_id);

        return view('offers.edit', compact('offer'));

    }

    public function delete($offer_id)
    {
        //check if offer id exists

        $offer = Offer::find($offer_id);   // Offer::where('id','$offer_id') -> first();

        if (!$offer)
            return redirect()->back()->with(['error' => __('messages.offer not exist')]);

        $offer->delete();

        return redirect()
            ->route('offers.all')
            ->with(['success' => __('messages.offer deleted successfully')]);

    }

    public function updateOffer(OfferRequest $request , $offer_id){
 
        // validtion 

        // chek if offer exists
        $offer = Offer::find($offer_id);
        if (!$offer)
            return redirect()->back();
        
        
        // update data
        $offer->update($request->all());
        return redirect()->route('offers.all')->with(['success' => 'messages.successfully updated']);

        /*  $offer->update([
              'name_ar' => $request->name_ar,
              'name_en' => $request->name_en,
              'price' => $request->price,
          ]);*/
        
    }
   
}
