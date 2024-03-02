<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CreateCarController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RemoveCarController;
use App\Http\Controllers\UpdateCarDataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// handle the login,logout, and redirections of a user
Route::view('/', 'index')->name('login')->middleware('guest');
Route::post('login', LoginController::class);
Route::get('logout', LogoutController::class);
Route::get('dashboard', DashboardController::class)->middleware('auth');
/* Route::get('/add/{name}', function($name){
    return view('add', ['name' => $name]);
}); */
Route::get('add', function() {
    return view('add');
});

// handle the adding of a car
Route::middleware(['auth'])->post('/cars', CreateCarController::class)->name('cars.store');

//handle the removal of a users car
Route::post('/remove', [RemoveCarController::class, 'Remove']);

//handle the update form
Route::post('/update', [UpdateCarDataController::class, 'Update'])->name('update');
Route::post('/edit', [UpdateCarDataController::class, 'Edit'])->name('edit');

// Show registration form
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Handle registration form submission
Route::post('/register', [RegisterController::class, 'register']);






