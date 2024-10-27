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
use Illuminate\Http\Request;

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
Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password')->middleware('signed');



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

        Route::resource('etapes', EtapeItineraireController::class);
        Route::get('/etapes', [EtapeItineraireController::class, 'index'])->name('etapes.index');
        Route::get('/etapes/create', [EtapeItineraireController::class, 'create'])->name('etapes.create');
        Route::post('/etapes', [EtapeItineraireController::class, 'store'])->name('etapes.store');
        Route::get('/etapes/{id}/edit', [EtapeItineraireController::class, 'edit'])->name('etapes.edit');
        Route::patch('/etapes/{id}', [EtapeItineraireController::class, 'update'])->name('etapes.update');
        Route::delete('/etapes/{id}', [EtapeItineraireController::class, 'destroy'])->name('etapes.destroy');
        Route::get('/avis', AvisC::class)->name('avis');


    });

    // Only client can access client-specific pages
    Route::middleware('role:client')->group(function () {
        Route::get('/destinationFront', DestinationFront::class)->name('destination-front');
        Route::get('/destinationFront/{id}', DestinationDetailF::class)->name('destination-detailF');
        Route::get('/itinerairesF', [ItineraireController::class, 'showForClient'])->name('itineraires.front');
        Route::get('/etapesF/{itineraire_id}', [EtapeItineraireController::class, 'frontIndex'])->name('etapes.frontIndex');
    });

    // Accessible to all authenticated users
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/static-sign-in', StaticSignIn::class)->name('sign-in');
    Route::get('/static-sign-up', StaticSignUp::class)->name('static-sign-up');
    Route::get('/rtl', Rtl::class)->name('rtl');
});
