<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlShortenerController;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/encode', [UrlShortenerController::class, 'encode']);
Route::get('/{code}', [UrlShortenerController::class, 'redirect']);  // Redirection route
Route::get('/decode/{code}', [UrlShortenerController::class, 'decode']);