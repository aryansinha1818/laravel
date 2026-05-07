<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('tasks.index') : view('auth.login');
})->name('home');

// Route with prefix group
Route::prefix('admin')->middleware(['auth'])->group(function () {

    // Resource controller route
    Route::resource('tasks', TaskController::class);
    Route::delete('tasks/delete-multiple', [TaskController::class, 'deleteMultiple'])->name('tasks.delete.multiple');

    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
});

// Named routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Localization routes
Route::get('/lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
})->name('lang.switch');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__ . '/auth.php';
