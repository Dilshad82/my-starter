<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/redirect/{service}', 'SocialController@redirect');

Route::get('/callback/{service}', 'SocialController@callback');














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




