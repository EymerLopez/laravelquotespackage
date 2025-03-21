<?php

use Eymer\LaravelQuotes\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

Route::prefix('quotes')->middleware(['throttle:laravelquotes'])->group(function () {
    Route::get('/', [QuoteController::class, 'index'])->name('api.quotes.index');
    Route::get('/random', [QuoteController::class, 'random'])->name('api.quotes.random');
    Route::get('/{id}', [QuoteController::class, 'show'])->whereNumber('id')->name('api.quotes.show');
});
