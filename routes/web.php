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
	Route::get('/dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('/{user:display_name}/events', [EventController::class, 'index'])->name('events.index');
	Route::get('/{user:display_name}/{event}', [EventController::class, 'show'])->name('events.show');
	Route::get('/new-event', [EventController::class, 'create'])->name('events.create');
	Route::post('/new-event', [EventController::class, 'store'])->name('events.store');
	Route::get('/{user:display_name}/guests', [PersonController::class, 'index'])->name('person.index');
	Route::get('/new-person', [PersonController::class, 'create'])->name('person.create');
	Route::post('/new-person', [PersonController::class, 'store'])->name('person.store');
	Route::get('/find-people', [SearchController::class, 'person']);

});


// Public Routes
Route::get('/', function () {
    return view('welcome');
});
Route::get('/rsvp/{user:display_name}/{any_event}', [EventController::class, 'respond'])->name('rsvp.show');
Route::get('/rsvp/{event}/find', [ResponseController::class, 'find']);

require __DIR__.'/auth.php';
