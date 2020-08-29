<?php 

namespace App\Traits ;

Trait OfferTrait 
{
   // save photo in folder ==> public\images\offers حفظ الصورة في الفولدر
   public function saveImage($photo , $folder){

    $file_extension = $photo -> getClientOriginalExtension(); //امتداد او مسار الصورة
    $file_name = time().'.'.$file_extension ; // اسم الصورة
    $path = $folder ;
    $photo  -> move($path , $file_name);

    return $file_name ;
}
}