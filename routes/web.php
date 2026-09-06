<?php

use App\Http\Controllers\AdoptionRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/request-form', [AdoptionRequestController::class, 'create'])->name('adoption-request.create');
Route::post('/request-form', [AdoptionRequestController::class, 'store'])->name('adoption-request.store');
