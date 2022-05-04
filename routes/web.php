<?php

use Illuminate\Support\Facades\Route;
use App\models\Gym;
use App\models\User;
use App\Http\Controllers\GymController;
use App\Http\Controllers\TrainingPackageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\CityManagerController;
use App\Http\Controllers\GymManagerController;
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


/*
* Gyms Routes
*/
Route::get('/gyms', [GymController::class, 'index'])->name('gyms.index');
Route::get('/gyms/create/', [GymController::class, 'create'])->name('gyms.create');
Route::post('/gyms', [GymController::class, 'store'])->name('gyms.store');
Route::delete('/gyms/{gym}', [GymController::class , 'destroy'])->name('gyms.destroy');
Route::get('/gyms/{gym}/edit' , [GymController::class, 'edit'])->name('gyms.edit');
Route::put('/gyms/{gym}', [GymController::class, 'update'])->name('gyms.update');

/*
* Training Packages Routes 
*/
Route::get('/training-packages', [TrainingPackageController::class, 'index'])->name('training_packages.index');
Route::get('/training-packages/create/', [TrainingPackageController::class, 'create'])->name('training_packages.create');
Route::post('/training-packages', [TrainingPackageController::class, 'store'])->name('training_packages.store');
Route::delete('/training-packages/{trainingPackage}', [TrainingPackageController::class , 'destroy'])->name('training_packages.destroy');
Route::get('/training-packages/{trainingPackage}/edit' , [TrainingPackageController::class, 'edit'])->name('training_packages.edit');
Route::put('/training-packages/{trainingPackage}', [TrainingPackageController::class, 'update'])->name('training_packages.update');

/*
* Users Routes
*/
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create/', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

/*
* Coaches Routes
*/
Route::get('/coaches', [CoachController::class, 'index'])->name('coaches.index');
Route::get('/coaches/create/', [CoachController::class, 'create'])->name('coaches.create');
Route::post('/coaches', [CoachController::class, 'store'])->name('coaches.store');
Route::get('/coaches/{coach}/edit' , [CoachController::class, 'edit'])->name('coaches.edit');
Route::put('/coaches/{coach}', [CoachController::class, 'update'])->name('coaches.update');
Route::delete('/coaches/{coach}', [CoachController::class , 'destroy'])->name('coaches.destroy');

Route::get('/city_managers', [CityManagerController::class, 'index'])->name('city_managers.index');
Route::get('/city_managers/create/', [CityManagerController::class, 'create'])->name('city_managers.create');
Route::post('/city_managers', [CityManagerController::class, 'store'])->name('city_managers.store');
Route::delete('/city_managers/{city_manager}', [CityManagerController::class , 'destroy'])->name('city_managers.destroy');
Route::get('/city_managers/{city_manager}/edit' , [CityManagerController::class, 'edit'])->name('city_managers.edit');
Route::put('/city_managers/{city_manager}', [CityManagerController::class, 'update'])->name('city_managers.update');

Route::get('/gym_managers', [GymManagerController::class, 'index'])->name('gym_managers.index');
Route::get('/gym_managers/create/', [GymManagerController::class, 'create'])->name('gym_managers.create');
Route::post('/gym_managers', [GymManagerController::class, 'store'])->name('gym_managers.store');
Route::delete('/gym_managers/{gym_manager}', [GymManagerController::class , 'destroy'])->name('gym_managers.destroy');
Route::get('/gym_managers/{gym_manager}/edit' , [GymManagerController::class, 'edit'])->name('gym_managers.edit');
Route::put('/gym_managers/{gym_manager}', [GymManagerController::class, 'update'])->name('gym_managers.update');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
