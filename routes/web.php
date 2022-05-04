<?php

use Illuminate\Support\Facades\Route;
use App\models\Gym;
use App\models\User;
use App\Http\Controllers\GymController;
use App\Http\Controllers\TrainingPackageController;
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
    // $g =Gym::find(8);
    // $u =User::find(1);
    // foreach ($u->training_sessions as $role) {
        
    //     echo $role->pivot;
    //     echo $role->pivot->created_at->diffForHumans();
    // }
    // dd($u->training_sessions);
    return view('devView');
});

// Route::get('/users', function () {
//     return view('tables.users');
// })->name('users.index');

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
Route::delete('/users/{user}', [UserController::class , 'destroy'])->name('users.destroy');
Route::get('/users/{user}/edit' , [UserController::class, 'edit'])->name('users.edit');
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
