<?php

use Illuminate\Support\Facades\Route;
use App\models\Gym;
use App\models\User;
<<<<<<< HEAD
use App\Http\Controllers\GymController;
use App\Http\Controllers\UserController;
=======
>>>>>>> 638077cbcd0c836b2fd1e8be51615d78277d4acf
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
<<<<<<< HEAD
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

Route::get('/gyms', [GymController::class, 'index'])->name('gyms.index');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create/', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::delete('/users/{user}', [UserController::class , 'destroy'])->name('users.destroy');
Route::get('/users/{user}/edit' , [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
=======
    $g =Gym::find(8);
    $u =User::find(1);
    foreach ($u->training_sessions as $role) {
        
        echo $role->pivot;
        echo $role->pivot->created_at->diffForHumans();
    }
    dd($u->training_sessions);
    return view('devView');
});
Route::get('/users', function () {
    return view('tables.users');
})->name('users.index');
>>>>>>> 638077cbcd0c836b2fd1e8be51615d78277d4acf

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
