<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\VillaController;
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

Route::get('/', function () {
    return view('welcome');
});

// ############################ Villa
Route::get('/villa', [VillaController::class, 'index'])->name('villa.index');
Route::get('/villa/create', [VillaController::class, 'create'])->name('villa.create');
Route::POST('/villa/store', [VillaController::class, 'store'])->name('villa.store');

// ############################ Customers
Route::GET('/customers', [CustomerController::class, 'index'])->name('customer.index');

Route::GET('/customers/form', [CustomerController::class, 'form'])->name('customer.form');
Route::POST('customers/store', [CustomerController::class, 'store'])->name('customer.store');

Route::GET('/mail/send', [MailController::class, 'send']);