<?php

use Eymer\LaravelQuotes\Http\Controllers\QuoteViewController;
use Illuminate\Support\Facades\Route;

Route::prefix('quotes-ui')->middleware(['web'])->group(function () {
    Route::get('/', [QuoteViewController::class, 'index'])->name('quotes.index');
    Route::get('/random', [QuoteViewController::class, 'random'])->name('quotes.random');
    Route::get('/{id}', [QuoteViewController::class, 'show'])->whereNumber('id')->name('quotes.show');
});
