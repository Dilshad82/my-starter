<?php



Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/redirect/{service}', 'SocialController@redirect');

Route::get('/callback/{service}', 'SocialController@callback');


Route::get('fillable' , 'Crudcontroller@getOffers' );

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::group(['prefix' => 'offers'] , function () {
        // Route::get('store' , 'CrudController@store');
        Route::get('create' , 'CrudController@create');
        Route::post('store' , 'CrudController@store')->name('offers.store');

        Route::get('edit/{offer_id}' , 'CrudController@editOffer');
        Route::post('update/{offer_id}' , 'CrudController@updateOffer')->name('offers.update');
        Route::get('delete/{offer_id}' , 'CrudController@delete')->name('offers.delete');

        Route::get('all', 'CrudController@getAllOffers')->name('offers.all');
    });
});

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

        Route::get('youtube', 'VideoController@getVideo') -> middleware('auth');
   
});


###################### Begin Ajax routes #####################
Route::group(['prefix' => 'ajax-offers'], function () {
    Route::get('create', 'OfferController@create');
    Route::post('store', 'OfferController@store')->name('ajax.offers.store');
    Route::get('all', 'OfferController@all')->name('ajax.offers.all');
    Route::post('delete', 'OfferController@delete')->name('ajax.offers.delete');
    Route::get('edit/{offer_id}', 'OfferController@edit')->name('ajax.offers.edit');
    Route::post('update', 'OfferController@Update')->name('ajax.offers.update');

});
###################### End Ajax routes #####################

Route::get('/dashboard', function () {

    return 'Not adult';
}) -> name('not.adult');

##################### Begin Authentication && Guards ##############
Route::group(['middleware' => 'CheckAge' , 'namespace' => 'Auth'], function () {
   Route::get('adults' , 'CustomAuthController@adult')->name('adult');
});
/////////////////// middleware -- auth ///////////////////////
Route::get('site', 'Auth\CustomAuthController@site')->middleware('auth:web')-> name('site');
Route::get('admin', 'Auth\CustomAuthController@admin')->middleware('auth:admin') -> name('admin');

Route::get('admin/login', 'Auth\CustomAuthController@adminLogin')-> name('admin.login');
Route::post('admin/login', 'Auth\CustomAuthController@checkAdminLogin')-> name('save.admin.login');
##################### End Authentication && Guards ##############


###################  Begin relations  routes ######################
  ###################  Begin One To One relations   ####################
Route::get('has-one','Relation\RelationsController@hasOneRelation');

Route::get('has-one-reverse','Relation\RelationsController@hasOneRelationRerverse');

Route::get('get-user-where-has-phone-with-condition','Relation\RelationsController@getUserWhereHasPhoneWithCondition');

Route::get('get-user-has-phone','Relation\RelationsController@getUserHasPhone');
  ###################  End One To One relations   ######################

  ###################  Begin One To Many relations   ###################
Route::get('hospital-has-many','Relation\RelationsController@getHospitalDoctors');

Route::get('hospitals','Relation\RelationsController@hospitals') -> name('hospital.all');

Route::get('doctors/{hospital_id}','Relation\RelationsController@doctors')-> name('hospital.doctors');


Route::get('hospitals/{hospital_id}','Relation\RelationsController@deleteHospital') -> name('hospital.delete');

Route::get('hospitals_has_doctors','Relation\RelationsController@hospitalsHasDoctor');

Route::get('hospitals_has_doctors_male','Relation\RelationsController@hospitalsHasOnlyMaleDoctors');

Route::get('hospitals_not_has_doctors','Relation\RelationsController@hospitals_not_has_doctors');
  ###################  End One To One relations   ######################

  ###################  Begin Many To Many relations   ###################
Route::get('doctors-services','Relation\RelationsController@getDoctorServices');
Route::get('service-doctors','Relation\RelationsController@getServiceDoctors');

Route::get('doctors/services/{doctor_id}','Relation\RelationsController@getDoctorServicesById')-> name('doctors.services');
Route::post('saveServices-to-doctor','Relation\RelationsController@saveServicesToDoctors')-> name('save.doctors.services');
  ###################  End Many To Many relations   #####################

  ###################  Begin  has on through relations   #####################
Route::get('has-one-through','Relation\RelationsController@getPatientDoctor');

   ###################  Begin  Many on through relations   #####################
Route::get('has-many-through','Relation\RelationsController@getCountryDoctor');

  ###################  End has one and many through relations   #####################
###################  End relations routes  ########################









// Route::get('/landing', function () {
//     return view('landing');
// });
// Route::get('/about', function () {
//     return view('about');
// });



// // Route::get('/test', function () {
// //     return view('welcome1');
// // });


// Route::get('index' , 'Front\UserController@getIndex');


// Route::get('/test1', function () {
//     return 'welcome';
// });

// // route parameters
// // 1. required parameters==>($id) ,, required==>مطلوب
// Route::get('/test2/{id}', function ($id) {

//     return $id;
// });
// // 2. optional parameters==>($id?) , optional={?}==>اختياري
// Route::get('/test3/{id?}', function () {

//     return 'welcome' ;
// });

// // route name
// Route::get('/show-number/{id}', function ($id) {

//     return $id;
// })->name('a');


// // 2. optional parameters==> ,, optional={?}==>اختياري
// Route::get('/show-string/{id?}', function () {

//     return 'welcome' ;
// })->name('b');

// // route Namespaces
// Route::namespace('Front')->group(function(){
//     // all route only access controller or methods in folder name=>Front
//        Route::get('users' , 'UserController@showUserName');
//    });
   
//    Route::group(['prefix' => 'users' , 'middleware' => 'auth'] , function(){
//     // set of routes
//     Route::get('/' , function(){
//         return 'work' ;
//     });
//     Route::get('show' , 'UserController@showUserName');
//     Route::delete('delete' , 'UserController@showUserName');
//     Route::get('edit' , 'UserController@showUserName');
//     Route::put('update' , 'UserController@showUserName');
// });



// Route::group(['namespace' => 'Admin' ] , function(){
    
//     Route::get('second' , 'SecondController@showString') ->middleware('auth');
//     Route::get('second0' , 'SecondController@showString0');
//     Route::get('second1' , 'SecondController@showString1');
//     Route::get('second2' , 'SecondController@showString2');
//      // Route::get('second' , 'Admin\UserController@showUserName');
// });
// Route::get('login' , function(){
//   return 'Must Be Login To Access This Route';
// })->name('login');

// // Route::get('/check' , function(){
// //     return 'middlware' ;
// // })->middlware('auth');

// Route::resource('news' , 'NewsController');




