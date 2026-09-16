<?php

use App\Http\Controllers\FrontendDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('frontend.dashboard');
})->name('home');

/*
|--------------------------------------------------------------------------
| Frontend & Node.js Environment Dashboard
|--------------------------------------------------------------------------
*/
Route::prefix('frontend-dashboard')->name('frontend.dashboard')->group(function () {
    Route::get('/', [FrontendDashboardController::class, 'index']);
    Route::post('/run-script', [FrontendDashboardController::class, 'runScript'])->name('.run-script');
    Route::get('/export', [FrontendDashboardController::class, 'export'])->name('.export');
});