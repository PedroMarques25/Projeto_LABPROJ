<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PurchaseController;
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

Route::get('/update-user-profile', [ProfileController::class, 'updateUserProfile'])->name('update-profile');


/*
|--------------------------------------------------------------------------
| Post Routes - UserController
|--------------------------------------------------------------------------
*/
Route::post('/signin', [UserController::class, 'store'])->name('signin');

Route::post('/login', [UserController::class, 'login'])->name('login');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Post Routes - ProfileController
|--------------------------------------------------------------------------
*/

Route::post('/update-user-profile', [ProfileController::class, 'updateUserProfile'])->name('update-profile');

Route::post('/update-profile-picture', [ProfileController::class, 'updateProfilePicture'])->name('update-profile-image');


/*
|--------------------------------------------------------------------------
| Delete Routes - ProfileController
|--------------------------------------------------------------------------
*/
Route::delete('/delete-profile', [ProfileController::class, 'deleteProfile'])->name('delete-profile');

/*
|--------------------------------------------------------------------------
| Get Routes - PurchaseController
|--------------------------------------------------------------------------
*/

Route::get("/my-cart", [\App\Http\Controllers\PurchaseController::class,'my_cart'])->name('my-cart');
