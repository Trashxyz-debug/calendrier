<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
  FullCalendarController, CalendrierController, EventController, BookController
};

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

Route::get('calendar', [EventController::class, 'index'])->name('calendar.index');
Route::post('calendar/create-event', [EventController::class, 'create'])->name('calendar.create');
Route::put('calendar/edit-event', [EventController::class, 'edit'])->name('calendar.edit');
Route::delete('calendar/remove-event', [EventController::class, 'destroy'])->name('calendar.destroy');

Route::get('book', [BookController::class, 'index'])->name('book.index');
Route::post('book/book-event', [BookController::class, 'create'])->name('book.create');

Route::view('/', 'welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/admin', function () {
    return view('home.admin');
})->middleware(['auth'])->name('admin');


require __DIR__.'/auth.php';
