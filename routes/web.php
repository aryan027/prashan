<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

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
    $tables = array();
    Session::forget('tables');
    Session::put('tables', $tables);
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/book', [BookingController::class, 'ListAvailability'])->name('booking');
Route::get('list-tables', [BookingController::class, 'LoadTablesInside'])->name('list.tables');
Route::post('book-table', [BookingController::class, 'ReserveTable'])->name('book.success');
Route::get('booking', [BookingController::class, 'bookingList'])->name('booking.list');
Route::post('booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
