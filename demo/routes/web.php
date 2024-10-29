<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [QuoteController::class, 'index']);
Route::post('/search', [QuoteController::class, 'search']);
Route::post('/addQuote', [QuoteController::class, 'store']);
Route::put('/updateQuote/{id}', [QuoteController::class, 'update']);
Route::delete('/deleteQuote/{id}', [QuoteController::class, 'destroy']);
