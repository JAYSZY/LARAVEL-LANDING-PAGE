<?php

use App\Http\Controllers\FacilityRequestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/request', function () {
    return view('requests.create');
})->name('request.create');

Route::post('/request', [FacilityRequestController::class, 'store'])
    ->name('request.store');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [FacilityRequestController::class, 'dashboard'])
        ->name('dashboard');

    Route::resource('facility-requests', FacilityRequestController::class)
        ->except(['create', 'store', 'show'])
        ->names('facility-requests');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
