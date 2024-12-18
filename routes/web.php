<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItineraireController;
use App\Http\Controllers\EtapeItineraireController;
use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\SignUp;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\AvisC;
use App\Http\Livewire\DestinationC;
use App\Http\Livewire\DestinationFront;
use App\Http\Livewire\DestinationDetailF;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Billing;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Tables;
use App\Http\Livewire\StaticSignIn;
use App\Http\Livewire\StaticSignUp;
use App\Http\Livewire\Rtl;
use App\Http\Livewire\LaravelExamples\UserProfile;
use App\Http\Livewire\LaravelExamples\UserManagement;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\ReservationController;

use Illuminate\Http\Request;
use App\Http\Controllers\Mail;

use App\Http\Controllers\HebergementController;

use App\Http\Controllers\ServiceHebergementController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\TransportItineraireController;

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

Route::get('/', function() {
    return redirect('/login');
});

Route::get('/sign-up', SignUp::class)->name('sign-up');
Route::get('/login', Login::class)->name('login');

Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}',ResetPassword::class)->name('reset-password')->middleware('signed');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/billing', Billing::class)->name('billing');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/tables', Tables::class)->name('tables');
    Route::get('/static-sign-in', StaticSignIn::class)->name('sign-in');
    Route::get('/static-sign-up', StaticSignUp::class)->name('static-sign-up');
    Route::get('/rtl', Rtl::class)->name('rtl');
    Route::get('/laravel-user-profile', UserProfile::class)->name('user-profile');
});

Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');
Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password')->middleware('signed');

Route::get('/etapes/export-test', [EtapeItineraireController::class, 'exportEtapes'])->name('etapes.export');


Route::middleware('auth')->group(function () {
    Route::get('/laravel-user-profile', UserProfile::class)->name('user-profile');
    
    // Only admin can access the dashboard and admin-specific pages
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
        Route::get('/billing', Billing::class)->name('billing');
        Route::get('/tables', Tables::class)->name('tables');
        Route::get('/laravel-user-management', UserManagement::class)->name('user-management');
        Route::get('/destination', DestinationC::class)->name('destination');
        Route::resource('itineraires', ItineraireController::class);
        Route::resource('reclamations', ReclamationController::class);
        Route::resource('reservations', ReservationController::class);
        
        Route::resource('etapes', EtapeItineraireController::class);
        Route::get('/etapes', [EtapeItineraireController::class, 'index'])->name('etapes.index');
        Route::get('/etapes/create', [EtapeItineraireController::class, 'create'])->name('etapes.create');
        Route::post('/etapes', [EtapeItineraireController::class, 'store'])->name('etapes.store');
        Route::get('/etapes/{id}/edit', [EtapeItineraireController::class, 'edit'])->name('etapes.edit');
        Route::patch('/etapes/{id}', [EtapeItineraireController::class, 'update'])->name('etapes.update');
        Route::delete('/etapes/{id}', [EtapeItineraireController::class, 'destroy'])->name('etapes.destroy');
        Route::get('/avis', AvisC::class)->name('avis');
        
        Route::resource('transport', TransportController::class);
        Route::resource('transport_itineraires', TransportItineraireController::class);
        Route::put('transport_itineraires/{id}', [TransportItineraireController::class,'update'])->name('transport_itineraires.update');
        
        
    Route::resource('hebergements', HebergementController::class);
    Route::put('/hebergements/{id}', [HebergementController::class, 'update'])->name('hebergements.update');

    Route::resource('services_hebergement', ServiceHebergementController::class);
    Route::put('/services_hebergement/{id}', [ServiceController::class, 'update'])->name('services_hebergement.update');




    });
    
    // Only client can access client-specific pages
    Route::middleware('role:client')->group(function () {
        Route::get('/destinationFront', DestinationFront::class)->name('destination-front');
        Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
        Route::post('/reclamation', [ReclamationController::class, 'store'])->name('reclamations.store');
        Route::get('/reclamation', [ReclamationController::class, 'showForClient'])->name('reclamation.front');
        Route::delete('/reservationF/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
        Route::get('/destinationFront/{id}', DestinationDetailF::class)->name('destination-detailF');
        Route::get('/itinerairesF', [ItineraireController::class, 'showForClient'])->name('itineraires.front');
        Route::get('/reservationF', [ReservationController::class, 'showForClient'])->name('reservation.front');
        
        Route::get('/etapesF/{itineraire_id}', [EtapeItineraireController::class, 'frontIndex'])->name('etapes.frontIndex');
        
Route::get('/heber', [HebergementController::class, 'showForHebergement'])->name('frontheberg.hebergfront');
Route::get('/serv/{id}', [ServiceHebergementController::class, 'frontIndex'])->name('frontheberg.serheber');

Route::get('/frontendIndex', [TransportController::class, 'frontendIndex'])->name('frontTransport.front');
Route::get('/frontdetails/{id}', [TransportItineraireController::class, 'frontIndex'])->name('frontTransport.showFront');


    });

    // Accessible to all authenticated users
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/static-sign-in', StaticSignIn::class)->name('sign-in');
    Route::get('/static-sign-up', StaticSignUp::class)->name('static-sign-up');
    Route::get('/rtl', Rtl::class)->name('rtl');
});
