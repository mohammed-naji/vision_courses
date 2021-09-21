<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PageController;

Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.home');
    Route::resource('categories', CategoryController::class);
    Route::resource('courses', CourseController::class);
});


Route::get('/', [PageController::class, 'index'])->name('homepage');
Route::get('course/{slug}', [PageController::class, 'course'])->name('course');

Route::get('register/{slug}', [PageController::class, 'register'])->name('register');
Route::post('register/{slug}', [PageController::class, 'registerSubmit']);

Route::get('pay/{id}', [PageController::class, 'pay'])->name('pay');
Route::get('thanks/{id}', [PageController::class, 'thanks'])->name('thanks');


Auth::routes(['register' => false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
