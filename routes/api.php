<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlShortenerController;

Route::post('/encode', [UrlShortenerController::class, 'encode']);
Route::get('/decode/{code}', [UrlShortenerController::class, 'decode']);