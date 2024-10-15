<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customerController;
use App\Http\Controllers\imageController;
Route::get('/', function () {
    return view('welcome');
});

Route::resource("/customer", customerController::class);

Route::get('/image', [App\Http\Controllers\imageController::class,'index']);
Route::post('/upload_file', [App\Http\Controllers\imageController::class,'storeupload'])->name('file.upload');
