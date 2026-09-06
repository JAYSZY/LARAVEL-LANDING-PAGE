<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/request', function () {
    return view('request');
})->name('request.show');
