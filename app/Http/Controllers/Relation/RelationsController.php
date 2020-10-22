<?php

namespace App\Http\Controllers\Relation;

use App\User;
use App\Models\Phone;
use App\Models\Doctor;
use App\Models\Country;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RelationsController extends Controller
{
    public function hasOneRelation()
    {   //Phone و ايضا بيانات ال  User نظهر بيانات ال 
        return $user = \App\User::with(['phone' => function ($q) {
            $q->select('code', 'phone', 'user_id');
        }])->find(8);

        //return $user -> phone -> code;
        // $phone = $user -> phone;

        return response()->json($user);
    }

    public function hasOneRelationRerverse(){

        // $phone = Phone::find(1) ;
        // $phone = Phone::with('user') -> find(1) ;
        $phone = Phone::with(['user' => function($q){
            $q -> select('id' , 'name');
        }]) -> find(1) ;

         // make some attribute visible 
        // في الدال فقط  user_id يقوم باظهار ال
        $phone -> makeVisible(['user_id']);
        // $phone -> makeHidden(['code']);
        
         // get all data phone + user 
        //return $phone -> user ; // return user of this phone number 

        //  return $phone  -> code ;
         return $phone ;
    }

    public function getUserHasPhone(){

      return  User::whereHas('phone') -> get();
    }

    public function getUserNotHasPhone(){

        return  User::whereDoesntHave('phone') -> get();
    }

    public function getUserWhereHasPhoneWithCondition()
    {
        return  User::whereHas('phone' , function($q){
            $q -> where('code' , '02') ;
        }) -> get();
    }

    ################### one to many relationship mehtods #########

    public function getHospitalDoctors(){
          // Hospital::first(); 
         // Hospital::where('id',1)->first(); 
        $hospital = Hospital::find(1);
         // return $hospital ;
        // return $hospital -> doctors ;
        // return $hospital = Hospital::with('doctors')->find(1);
        $hospital = Hospital::with('doctors')->find(1);
       //return $hospital -> name ;
       $doctors = $hospital -> doctors ;
      /*
       foreach($doctors as $doctor){
         echo $doctor -> name . '<br>' ;
       }
      */
       $doctor = Doctor::find(3);
    //return $doctor -> hospital ; 
       return $doctor -> hospital -> name; 
    }

    public function hospitals(){
        $hospitals = Hospital::select('id' , 'name' , 'address')->get();
        return view('doctors.hospitals' , compact('hospitals'));
    }

    public function doctors($hospital_id)
    {
        $hospital = Hospital::find($hospital_id);
        $doctors = $hospital->doctors;
        return view('doctors.doctors', compact('doctors'));
    }

    // get all hospital which must has doctors
    public function hospitalsHasDoctor()
    {
        return $hospitals = Hospital::whereHas('doctors')->get();
    }

    public function hospitalsHasOnlyMaleDoctors()
    {
        // return $hospitals = Hospital::whereHas('doctors', function ($q) {
        return $hospitals = Hospital::with('doctors')->whereHas('doctors', function ($q) {
            $q->where('gender', 1);
        })->get();
    }

    public function hospitals_not_has_doctors()
    {
        return Hospital::whereDoesntHave('doctors')->get();
    }

    public function deleteHospital($hospital_id)
    {
        $hospital = Hospital::find($hospital_id);
        if (!$hospital)
            return abort('404');
        //delete doctors in this hospital
        $hospital->doctors()->delete();
        $hospital->delete();

        //return redirect() -> route('hospital.all');
    }

    public function getDoctorServices(){

        return $doctor = Doctor::with('services')->find(3);

        // return  $doctor->services ;
        // return  $doctor->name ;
    }

    public function getServiceDoctors(){

       return  $doctors = Service::with(['doctors' => function($q) {
           $q -> select('doctors.id' , 'name' , 'title');
       }])->find(1);
        
    }

    public function getDoctorServicesById($doctorId){

        $doctor = Doctor::find($doctorId);
        $services = $doctor->services; // doctor services

        $doctors = Doctor::select('id' , 'name') -> get();
        $allServices = Service::select('id' , 'name') -> get(); // all database services
        return view('doctors.services' , compact('services' , 'doctors' , 'allServices'));
    }

    public function saveServicesToDoctors(Request $request)
    {   // return $request ;

        $doctor = Doctor::find($request->doctor_id);
        if (!$doctor)
            return abort('404');
        // many to many insert to database 
        // attach == تمسح ب التكرار
        // $doctor ->services()-> attach($request -> servicesIds);
        // sync == تمسح القديم و تخزن الجديد  
        //$doctor ->services()-> sync($request -> servicesIds);
        //syncWithoutDetaching == لا تحذف القديم ولا تقبل بالتكرار
        $doctor->services()->syncWithoutDetaching($request->servicesIds);
        return 'success';
    }

   public function getPatientDoctor(){

    //  return $patient = Patient::find(2);

        $patient = Patient::find(2);
        return $patient -> doctor ;
   }

   public function getCountryDoctor(){

    //   return $country = Country::find(1);

      $country = Country::find(1);
      return $country -> doctors ;

   }
}
