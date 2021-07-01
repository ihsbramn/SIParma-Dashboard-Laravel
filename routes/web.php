<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('report', ReportController::class);
Route::get('/filter/home', [HomeController::class, 'filter'])->name('filter.home');
Route::get('export_excel', [App\Http\Controllers\ReportController::class, 'export_excel'])->name('report');
Route::get('search', [App\Http\Controllers\ReportController::class, 'search'])->name('search');
Route::post('datefilter', [App\Http\Controllers\ReportController::class, 'datefilter'])->name('datefilter');

