<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceOfferController;

use App\Http\Controllers\ServiceOffersController;
use App\Http\Controllers\ServiceRequestController;
use Illuminate\Support\Facades\Route;
use Namu\WireChat\Livewire\Chat\Index;
use Namu\WireChat\Livewire\Chat\View;

Route::get('/', function () {
    return redirect()->route('check-account');
})->middleware('guest');

Route::get('/check-account', function () {
    return view('check-account');
})->middleware('guest')->name('check-account');

Route::get('/repair-car', function () {
    return redirect()->route('register', ['type' => 'repair']);
})->middleware('guest')->name('repair-car');
Route::get('/have-service', function () {
    return redirect()->route('register', ['type' => 'service']);
})->middleware('guest')->name('have-service');
Route::get('/select-role', function () {
    return view('select-role');
})->middleware('guest')->name('select-role');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('cars', CarController::class)
    ->middleware('role:3')
    ->names([
        'index' => 'cars',
    ]);

//КЛИЕНТ заявки
Route::get('client/requests', [ServiceRequestController::class, 'client_index'])->middleware('role:3')->name('client.requests');
Route::get('client/requests/create', [ServiceRequestController::class, 'create'])->middleware('role:3')->name('client.requests.create');
Route::post('client/requests/store', [ServiceRequestController::class, 'store'])->middleware('role:3')->name('client.requests.store');
Route::delete('client/requests/delete/{serviceRequest}', [ServiceRequestController::class, 'destroy'])->middleware('role:3')->name('client.requests.destroy');
Route::get('client/requests/show/{serviceRequest}', [ServiceRequestController::class, 'show'])->middleware('role:3')->name('client.requests.show');
Route::get('client/requests/edit/{serviceRequest}', [ServiceRequestController::class, 'edit'])->middleware('role:3')->name('client.requests.edit');
Route::patch('client/requests/update/{serviceRequest}', [ServiceRequestController::class, 'update'])->middleware('role:3')->name('client.requests.update');

//СЕРВИС заявки
Route::get('service/requests', [ServiceRequestController::class, 'service_index'])->middleware('role:2')->name('service.requests');

Route::resource('service', ServiceController::class)
    ->middleware('role:2');

Route::post('service/offers/store', [ServiceOfferController::class, 'store'])->name('service.offers.store');
Route::get('service/offers/history', [ServiceOfferController::class, 'history'])->name('service.offers.history');
Route::get('/service/{service}/index', [ServiceOfferController::class, 'service_index'])
    ->name('service.offers.index');


//КЛИЕНТ ответы от сервиса  МНОГО
Route::get('client/offers', [ServiceOfferController::class, 'client_index'])->name('client.offers');
//КЛИЕНТ ответ от сервиса  ОДИН
Route::get('client/offer/{service_request}', [ServiceOfferController::class, 'client_offer'])->name('client.offer');
Route::post('/offers/{offer}/accept', [ServiceOfferController::class, 'acceptOffer'])->name('offers.accept');

Route::patch('/offers/{offer}/update-status', [ServiceOfferController::class, 'updateStatus'])->name('offers.updateStatus');
Route::post('/service/{service}/review', [ReviewController::class, 'store'])->name('service.review');

require __DIR__.'/auth.php';


