<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// ✅ No auth middleware
Route::prefix('tasks')->name('tasks.')->controller(TaskController::class)->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{task}', 'show')->name('show');
    Route::get('/{task}/edit', 'edit')->name('edit');
    Route::put('/{task}', 'update')->name('update');
    Route::delete('/{task}', 'destroy')->name('destroy');
    Route::patch('/{task}/complete', 'complete')->name('complete');
});

// Home route
Route::get('/', function () {
    return redirect()->route('tasks.index');
});
