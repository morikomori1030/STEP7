<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('products.index');
})->middleware(['auth']);

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {

    Route::resource('products', ProductController::class);

    Route::get('/dashboard', function () {
        return redirect()->route('products.index');
    })->name('dashboard');
});
