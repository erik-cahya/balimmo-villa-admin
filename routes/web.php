<?php

use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Docs\DocsVisitController;
use App\Http\Controllers\Admin\Docs\DocsOfferToPurchaseController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LocalizationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PropertiesController;
use App\Http\Controllers\Admin\PropertiesFeatureController;
use App\Http\Controllers\Admin\PropertiesLeadsController;
use App\Http\Controllers\Admin\ProspectController;
use App\Http\Controllers\Landing\LandingPageController;
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
Route::get('/client-agent', [ClientController::class, 'search'])->name('client.search');


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
    Route::post('/properties/change_acceptance/{slug}', [PropertiesController::class, 'changeAcceptance'])->name('properties.changeAcceptance'); // Accept Listing Properties
    Route::resource('/properties', PropertiesController::class)->except(['show']); // CRUD Property Management
    Route::resource('/properties/features', PropertiesFeatureController::class)->except(['show', 'create']); // CRUD Feature & Ammenities
    Route::get('/properties/{slug}', [PropertiesController::class, 'detail'])->name('properties.details'); // See Properties Detail

    Route::get('/agent/{refcode}/properties', [AgentController::class, 'agentProperty'])->name('agent.properties'); // See Properties Listing From Agents
    Route::get('/agent/{refcode}', [AgentController::class, 'detailAgent'])->name('agent.detail'); // See Detail Data Agents
    Route::post('/agent/change-password', [AgentController::class, 'changePassword'])->name('agent.changePassword'); // Change Password Agents
    Route::resource('/agent', AgentController::class); // CRUD Agent
    Route::post('/agent/reactivate/{id}', [AgentController::class, 'reactivate']); // Turn ON Agent Account

    Route::post('/leads/sendmail', [PropertiesLeadsController::class, 'sendMail'])->name('leads.sendmail');
    Route::resource('/leads', PropertiesLeadsController::class);

    // Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');

    Route::resource('/profile', ProfileController::class);

    Route::delete('/gallery-images/{id}', [GalleryController::class, 'deleteImage'])->name('gallery-images.destroy');
    Route::get('/galleries/{gallery}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::post('/galleries/{gallery}/update', [GalleryController::class, 'update'])->name('gallery.update');

    Route::get('/visit/generate/english', [DocsVisitController::class, 'generateEnglishPDF'])->name('visit.pdf.english');
    Route::post('/visit/generate/english', [DocsVisitController::class, 'generateEnglishPDF'])->name('visit.pdf.english.post');
    Route::resource('/visit', DocsVisitController::class);

    Route::post('clients/leads', [ClientController::class, 'dataFromLeads'])->name('client.fromLeads');
    Route::resource('/clients', ClientController::class);

    Route::get('/api/regions', [RegionController::class, 'getRegions'])->name('api.regions');
    Route::post('localization/addRegion', [LocalizationController::class, 'addRegion'])->name('localization.addRegion')->middleware('role:Master');
    Route::resource('localization', LocalizationController::class)->middleware('role:Master');

    Route::post('offer-purchase/generate/english', [DocsOfferToPurchaseController::class, 'generateEnglishPDF'])->name('offer-purchase.pdf.english');
    Route::get('getDataProperties/{id}', [DocsOfferToPurchaseController::class, 'getPropertiesAjax'])->name('getPropertiesAjax');
    Route::get('getDataClients/{id}', [DocsOfferToPurchaseController::class, 'getClientsAjax'])->name('getClientsAjax');
    Route::resource('offer-purchase', DocsOfferToPurchaseController::class);

    Route::resource('prospects', ProspectController::class);
});

// Route::get('/mail', [MailController::class, 'send'])->name('sendmail');

require __DIR__ . '/auth.php';
