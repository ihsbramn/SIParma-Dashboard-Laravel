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
Route::get('home.filter', [HomeController::class, 'filter'])->name('home.filter');

Route::get('report.export', [App\Http\Controllers\ReportController::class, 'export'])->name('report.export');
Route::get('search', [App\Http\Controllers\ReportController::class, 'search'])->name('report.search');

Route::get('datefilter', [App\Http\Controllers\ReportController::class, 'datefilter'])->name('report.datefilter');
Route::get('datefilter_open', [App\Http\Controllers\ReportController::class, 'datefilter_open'])->name('report.open.datefilter');
Route::get('datefilter_ogp', [App\Http\Controllers\ReportController::class, 'datefilter_ogp'])->name('report.ogp.datefilter');
Route::get('datefilter_eskalsi', [App\Http\Controllers\ReportController::class, 'datefilter_eskalsi'])->name('report.eskalasi.datefilter');
Route::get('datefilter_closed', [App\Http\Controllers\ReportController::class, 'datefilter_closed'])->name('report.closed.datefilter');

Route::get('report.open', [App\Http\Controllers\ReportController::class, 'open'])->name('report.open');
Route::get('report.ogp', [App\Http\Controllers\ReportController::class, 'ogp'])->name('report.ogp');
Route::get('report.eskalasi', [App\Http\Controllers\ReportController::class, 'eskalasi'])->name('report.eskalasi');
Route::get('report.closed', [App\Http\Controllers\ReportController::class, 'closed'])->name('report.closed');

