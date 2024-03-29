<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\PersonController;

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

// Private Routes

Route::middleware(['auth'])->group(function () {

	Route::get('/events', [EventController::class, 'index'])->name('events.index');
	Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::patch('/events/{event}/update', [EventController::class, 'update'])->name('events.update');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
	Route::get('/new-event', [EventController::class, 'create'])->name('events.create');
	Route::post('/new-event', [EventController::class, 'store'])->name('events.store');
	Route::get('/directory', [PersonController::class, 'index'])->name('person.index');
    Route::get('/directory/{person}', [PersonController::class, 'edit'])->name('person.edit');
    Route::patch('/directory/{person}', [PersonController::class, 'update'])->name('person.update');
	Route::get('/new-person', [PersonController::class, 'create'])->name('person.create');
	Route::post('/new-person', [PersonController::class, 'store'])->name('person.store');
	Route::get('/find-people', [SearchController::class, 'person']);
});

// Public Routes
Route::get('/', function () {
    return redirect('/login');
});
Route::get('/rsvp/{user:display_name}/{any_event}', [EventController::class, 'respond'])->name('rsvp.show');
Route::get('/rsvp/{event}/find', [ResponseController::class, 'find']);

require __DIR__.'/auth.php';
