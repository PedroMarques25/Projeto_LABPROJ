<?php

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

Route::get("/", [TestController::class,'home']);

Route::get('/index', [TestController::class,'index']);

Route::get('/team', [TestController::class,'about']);

Route::get('/login', [TestController::class,'login']);

Route::get('/signin', [TestController::class,'signin']);

Route::get('/contact', [TestController::class,'contact']);

Route::get('/profile', [TestController::class,'profile']);



/*
|--------------------------------------------------------------------------
| Post Routes
|--------------------------------------------------------------------------
*/
Route::post('/signin', [UserController::class, 'store'])->name('user.signin');

Route::post('/login', [UserController::class, 'login'])->name('user.login');

