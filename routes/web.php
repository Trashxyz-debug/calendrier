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

Route::get('/admin', [EventController::class, 'index'])->middleware(['auth', 'isadmin'])->name('calendar.index');
Route::post('/admin/create-event', [EventController::class, 'create'])->middleware(['auth', 'isadmin'])->name('calendar.create');
Route::put('/admin/edit-event', [EventController::class, 'edit'])->middleware(['auth', 'isadmin'])->name('calendar.edit');
Route::delete('/admin/remove-event', [EventController::class, 'destroy'])->middleware(['auth', 'isadmin'])->name('calendar.destroy');

Route::get('/', [BookController::class, 'index'])->name('book.index');
Route::post('book/book-event', [BookController::class, 'create'])->middleware(['auth' ,'verified'])->name('book.create');

// Route::view('/', 'welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::get('/admin', function () {
//     return view('home.admin');
// })->middleware(['auth'])->name('admin');

Route::get('test', function () {
    return view('tel');
});

require __DIR__.'/auth.php';
