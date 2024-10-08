<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customerController;
Route::get('/', function () {
    return view('welcome');
});

Route::resource("/customer", customerController::class);
