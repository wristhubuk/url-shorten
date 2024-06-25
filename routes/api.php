<?php

use App\Http\Controllers\UrlShortenerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/* Encode URL
    ** @route POST /encode
*/
Route::post('/encode', [UrlShortenerController::class, 'encode']);

/* Decode URL
    ** @route GET /decode
*/
Route::get('/decode', [UrlShortenerController::class, 'decode']);
