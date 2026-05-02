<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});
//shortcut method
// Route::view('/home', 'home');

//passing inside view as a param
Route::get('/about/{name}', function ($name) {
    // echo $name;
    return view('about', ['name' => $name]);
});
//passing inside function
// Route::get('/about/{name}', function ($name) {
//     echo $name;
//     return view('about');
// });

//redirect - where and then which to open


//controller
Route::get('/user', [Usercontroller::class, 'getUser']);
Route::get('/a', [Usercontroller::class, 'aboutUser']);
// Route::view('/about2', 'about2');

Route::get('/about2', UserController::class . '@userhome2');

Route::get('admin', function () {
    return view('admin.admin');
});
