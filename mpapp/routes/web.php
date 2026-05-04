<?php

use App\Http\Controllers\form2Controller;
use App\Http\Controllers\Form3Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormController;


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

Route::get('/form', [FormController::class, 'showForm']);
Route::post('/form', [FormController::class, 'addUser']);
Route::post('/form', [FormController::class, 'showAll']);

Route::get('/form2', [form2Controller::class, 'showForm']);
Route::post('/form2', [form2Controller::class, 'submitForm']);


Route::get('/form3', [Form3Controller::class, 'showForm']);
Route::post('/form3', [Form3Controller::class, 'submitForm']);

// the concept of url in laravel
Route::get('/home3', function () {
    return view('home3');
});

Route::view('us', 'home3');
Route::view('about3/{name}', 'about3');
