<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\PropertiesController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// view our form page
Route::get('/form', [FormController::class, 'index'])->name('form.index');
Route::post('/form-submit', [FormController::class, 'submit'])->name('form.submit');
Route::post('/form-upload', [FormController::class, 'upload'])->name('form.upload');

// handle form request

Route::get('/', function () {
    return view('landing.index');
});
Route::get('/listing', function () {
    return view('landing.listing');
});
Route::get('/blog', function () {
    return view('landing.blog');
});
Route::get('/about', function () {
    return view('landing.about');
});
Route::get('/contact', function () {
    return view('landing.contact');
});




Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('/properties', PropertiesController::class)->except('show');
    Route::get('/properties/{slug}', [PropertiesController::class, 'detail'])->name('properties.details');
    Route::resource('/features', FeatureController::class);

    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
