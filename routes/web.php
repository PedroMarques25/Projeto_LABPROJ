<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


/*
|--------------------------------------------------------------------------
| Get Routes
|--------------------------------------------------------------------------
*/

Route::get("/", [TestController::class,'home'])->name('home');

Route::get('/index', [TestController::class,'index'])->name('index');

Route::get('/team', [TestController::class,'about']) ->name('about');

Route::get('/login', [TestController::class,'login']) ->name('login');

Route::get('/signin', [TestController::class,'signin']) ->name('signin');

Route::get('/contact', [TestController::class,'contact']) -> name('contact');

Route::get('/profile', [TestController::class, 'profile'])->name('profile');

Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('edit-profile');

/*
|--------------------------------------------------------------------------
| Post Routes
|--------------------------------------------------------------------------
*/
Route::post('/signin', [UserController::class, 'store'])->name('user.signin');

Route::post('/login', [UserController::class, 'login'])->name('user.login');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::post('/update-bio', [ProfileController::class, 'updateBio'])->name('update-bio');

Route::post('/update-user-profile', [ProfileController::class, 'updateUserProfile'])->name('update-profile');


