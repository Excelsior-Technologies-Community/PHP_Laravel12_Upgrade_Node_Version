<?php

use App\Http\Controllers\FrontendDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Welcome Page
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


/*
|--------------------------------------------------------------------------
| Frontend Environment Dashboard
|--------------------------------------------------------------------------
*/

Route::get(
    '/frontend-dashboard',
    [
        FrontendDashboardController::class,
        'index'
    ]
)->name('frontend.dashboard');


/*
|--------------------------------------------------------------------------
| Export Dashboard Report
|--------------------------------------------------------------------------
*/

Route::get(
    '/frontend-dashboard/export',
    [
        FrontendDashboardController::class,
        'export'
    ]
)->name('frontend.dashboard.export');