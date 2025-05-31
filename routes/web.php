<?php

use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PropertiesController;
use App\Http\Controllers\Admin\PropertiesFeatureController;
use App\Http\Controllers\Admin\PropertiesLeadsController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\Landing\LandingPageController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RegionController;
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

Route::get('/search-property', [LandingPageController::class, 'search'])->name('property.search');
Route::post('/search', [LandingPageController::class, 'filter'])->name('filter.properties');
Route::get('/search-agent', [AgentController::class, 'search'])->name('agent.search');



// view our form page
Route::get('/form', [FormController::class, 'index'])->name('form.index');
Route::post('/form-submit', [FormController::class, 'submit'])->name('form.submit');
Route::post('/form-upload', [FormController::class, 'upload'])->name('form.upload');

// ############################################################### Landing Page Controller
Route::get('/', [LandingPageController::class, 'index'])->name('landing-page.index');
Route::get('/contact', [LandingPageController::class, 'contact'])->name('landing-page.contact');
Route::get('/about', [LandingPageController::class, 'about'])->name('landing-page.about');

Route::get('/listing', [LandingPageController::class, 'listing'])->name('landing-page.listing');
Route::get('/listing/{slug}', [LandingPageController::class, 'listingDetail'])->name('landing-page.listing.detail');

Route::get('/blog', [LandingPageController::class, 'blog'])->name('landing-page.blog');
Route::get('/landing-login', [LandingPageController::class, 'login'])->name('landing-page.login');
Route::get('/landing-signup', [LandingPageController::class, 'signup'])->name('landing-page.sign-up');

// ############################################################### Customer Booking Controller
Route::post('/booking', [PropertiesLeadsController::class, 'booking'])->name('booking');
Route::post('/booking/{slug}', [PropertiesLeadsController::class, 'booking'])->name('booking.slug');
Route::post('listing/booking/{slug}', [CustomerController::class, 'booking'])->name('customer.booking');


Route::middleware('auth')->group(function () {

    // ############################################################### Admin Panel Controller
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/properties/change_acceptance/{slug}', [PropertiesController::class, 'changeAcceptance'])->name('properties.changeAcceptance');
    Route::resource('/properties', PropertiesController::class)->except(['show']);

    Route::resource('/properties/features', PropertiesFeatureController::class)->except(['show', 'create']);

    Route::get('/properties/{slug}', [PropertiesController::class, 'detail'])->name('properties.details');

    Route::get('/agent/{refcode}/properties', [AgentController::class, 'agentProperty'])->name('agent.properties');
    Route::get('/agent/{refcode}', [AgentController::class, 'detailAgent'])->name('agent.detail');
    Route::post('/agent/change-password', [AgentController::class, 'changePassword'])->name('agent.changePassword');
    Route::resource('/agent', AgentController::class);

    Route::post('/leads/sendmail', [PropertiesLeadsController::class, 'sendMail'])->name('leads.sendmail');
    Route::resource('/leads', PropertiesLeadsController::class);

    Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');

    Route::resource('/profile', ProfileController::class);
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::delete('/gallery-images/{id}', [GalleryController::class, 'deleteImage'])->name('gallery-images.destroy');
    Route::get('/galleries/{gallery}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::post('/galleries/{gallery}/update', [GalleryController::class, 'update'])->name('gallery.update');

    Route::get('/api/regions', [RegionController::class, 'getRegions'])->name('api.regions');
});

Route::get('/mail', [MailController::class, 'send'])->name('sendmail');

require __DIR__ . '/auth.php';
