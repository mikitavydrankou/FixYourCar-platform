<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\ProfileController;
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


Route::get('client/requests', [ServiceRequestController::class, 'client_index'])->name('client.requests');
Route::get('client/requests/create', [ServiceRequestController::class, 'create'])->name('client.requests.create');
Route::post('client/requests/store', [ServiceRequestController::class, 'store'])->name('client.requests.store');
Route::delete('client/requests/delete/{serviceRequest}', [ServiceRequestController::class, 'destroy'])->name('client.requests.destroy');
Route::get('client/requests/show/{serviceRequest}', [ServiceRequestController::class, 'show'])->name('client.requests.show');
Route::get('client/requests/edit/{serviceRequest}', [ServiceRequestController::class, 'edit'])->name('client.requests.edit');
Route::patch('client/requests/update/{serviceRequest}', [ServiceRequestController::class, 'update'])->name('client.requests.update');

require __DIR__.'/auth.php';


