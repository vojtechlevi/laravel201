<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CreateCarController;
use App\Http\Controllers\Auth\RegisterController;


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

Route::view('/', 'index')->name('login')->middleware('guest'); //startpage, takes user to login
//Route::post('login', LoginController::class);
Route::post('login', LoginController::class); //login page, if succesful login takes user to dashboard
Route::get('logout', LogoutController::class);
Route::get('dashboard', DashboardController::class)->middleware('auth'); //dashboardpage, where user can see and add cars
Route::middleware(['auth'])->post('/cars', CreateCarController::class)->name('cars.store'); //when adding a car it goes via this controller route


// Show registration form
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Handle registration form submission
Route::post('/register', [RegisterController::class, 'register']);




