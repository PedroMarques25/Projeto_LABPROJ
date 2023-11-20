<?php

use App\Http\Controllers\TestController;
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



Route::get("/", [TestController::class,'home']);

Route::get('/index', [TestController::class,'index']);

Route::get('/about', [TestController::class,'about']);

Route::get('/login', [TestController::class,'login']);

Route::get('/signin', [TestController::class,'signin']);

