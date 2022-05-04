<?php

use Illuminate\Support\Facades\Route;
use App\models\Gym;
use App\models\User;
use App\Http\Controllers\GymController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoachController;
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
    return view('devView');
});


Route::get('/gyms', [GymController::class, 'index'])->name('gyms.index');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create/', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

Route::get('/coaches', [CoachController::class, 'index'])->name('coaches.index');
Route::get('/coaches/create/', [CoachController::class, 'create'])->name('coaches.create');
Route::post('/coaches', [CoachController::class, 'store'])->name('coaches.store');
Route::get('/coaches/{coach}/edit' , [CoachController::class, 'edit'])->name('coaches.edit');
Route::put('/coaches/{coach}', [CoachController::class, 'update'])->name('coaches.update');
Route::delete('/coaches/{coach}', [CoachController::class , 'destroy'])->name('coaches.destroy');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
