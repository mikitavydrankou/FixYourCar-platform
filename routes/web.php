<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Namu\WireChat\Livewire\Chat\Index;
use Namu\WireChat\Livewire\Chat\View;

Route::get('/', function () {
    return redirect()->route('check-account');
})->middleware('guest');

Route::get('/check-account', function () {
    return view('check-account');
})->name('check-account');

Route::get('/repair-car', function () {
    return redirect()->route('register', ['type' => 'repair']);
})->name('repair-car');
Route::get('/have-service', function () {
    return redirect()->route('register', ['type' => 'service']);
})->name('have-service');
Route::get('/select-role', function () {
    return view('select-role');
})->name('select-role');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


