<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DisplayRoutesAndAttractionsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RouterController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PurchaseController;
use App\Mail\MailableTIMCity;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;

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

Route::get("/", [HomeController::class,'home'])->name('home');

Route::get('/index', [HomeController::class,'index'])->name('index');

Route::get('/team', [HomeController::class,'about']) ->name('about');

Route::get('/login', [HomeController::class,'login']) ->name('login');

Route::get('/signin', [HomeController::class,'signin']) ->name('signin');

Route::get('/contact', [HomeController::class,'contact']) -> name('contact');

Route::get('/profile-user', [UserController::class, 'profile'])->name('profile');

Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('edit-profile');

Route::get('/update-user-profile', [ProfileController::class, 'updateUserProfile'])->name('update-profile');

/*
|--------------------------------------------------------------------------
| Get Routes - PDFController
|--------------------------------------------------------------------------
*/

Route::get('generate-pdf', [PDFController::class, 'generatePDF']);
Route::get('/generate-pdf-report', [PDFController::class, 'generatePDF_report'])->name('generate.pdf.report');



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
| get Routes - ProfileController
|--------------------------------------------------------------------------
*/

Route::get('/become-guide', [ProfileController::class, 'becameAGuide'])->name('become-guide');

Route::get('/update-profile-picture', [ProfileController::class, 'updateProfilePicture'])->name('update-profile-image');

Route::get('/delete-profile', [ProfileController::class, 'deleteProfile'])->name('delete-profile');

Route::get('/delete-guide', [ProfileController::class, 'removeGuide'])->name('delete-guide');


/*
|--------------------------------------------------------------------------
| Post Routes - ProfileController
|--------------------------------------------------------------------------
*/

Route::post('/update-user-profile', [ProfileController::class, 'updateUserProfile'])->name('update-profile');

Route::post('/update-profile-picture', [ProfileController::class, 'updateProfilePicture'])->name('update-profile-image');

Route::post('/become-guide', [ProfileController::class, 'createGuide'])->name('register-guide');


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

Route::get("/my-cart", [PurchaseController::class,'viewCart'])->name('my-cart');
Route::get('/route/{routeId}/add-to-cart', [PurchaseController::class,'addToCart'])->name('route.addToCart');


/*
|--------------------------------------------------------------------------
| Get Routes - DisplayRoutesAndAttractionsController
|--------------------------------------------------------------------------
*/
Route::get('/profile', [DisplayRoutesAndAttractionsController::class, 'showProfile'])->name('show.profile')->middleware(['auth', 'verified']);
Route::get('/search-routes', [DisplayRoutesAndAttractionsController::class, 'searchRoutes'])->name('search.routes');
Route::get('/display-attractions', [DisplayRoutesAndAttractionsController::class, 'index'])->name('display.attractions');


/*
|--------------------------------------------------------------------------
| Get Routes - Admin
|--------------------------------------------------------------------------
*/
Route::resource('countries', CountryController::class);

/*
|--------------------------------------------------------------------------
| Get Routes - RouteController
|--------------------------------------------------------------------------
*/
Route::get('/routes/{id}', [RouterController::class, 'show'])->name('routes.show');
Route::get('/add-new-route', [RouterController::class, 'store'])->name('routes.store');

/*
|--------------------------------------------------------------------------
| Post Routes - RouteController
|--------------------------------------------------------------------------
*/

Route::post('/add-new-route', [RouterController::class, 'store'])->name('routes.store');
Route::post('/new-route-confirm', [RouterController::class, 'creation'])->name('routes.creation');


/*
|--------------------------------------------------------------------------
| Delete Routes - RouteController
|--------------------------------------------------------------------------
*/
Route::delete('routes/{routeID}', [RouterController::class, 'deleteRoute'])->name('route.delete');

/*
|--------------------------------------------------------------------------
| Get Routes - AttractionController
|--------------------------------------------------------------------------
*/
Route::get('/add-new-attraction', [AttractionController::class, 'store'])->name('attraction.store');

/*
|--------------------------------------------------------------------------
| Post Routes - AttractionController
|--------------------------------------------------------------------------
*/

Route::post('/add-new-attraction', [AttractionController::class, 'store'])->name('attraction.store');
Route::post('/new-attraction-confirm', [AttractionController::class, 'creation'])->name('attraction.creation');

/*
|--------------------------------------------------------------------------
| Get Routes - AdminController
|--------------------------------------------------------------------------
*/

Route::get('/admin-index-page', [AdminController::class, 'admin_index_page'])->name('admin.index');
Route::get('/admin-all-routes', [AdminController::class, 'admin_all_routes'])->name('admin.all.routes');
Route::get('/admin-all-guides', [AdminController::class, 'admin_all_guides'])->name('admin.all.guides');
Route::get('/admin-all-users', [AdminController::class, 'admin_all_users'])->name('admin.all.users');
Route::get('/admin-all-attractions', [AdminController::class, 'admin_all_attractions'])->name('admin.all.attractions');
Route::get('/admin-charts', [AdminController::class, 'admin_charts'])->name('admin.charts');


/*
|--------------------------------------------------------------------------
| Get Routes - StripeController
|--------------------------------------------------------------------------
*/
Route::get('/success', [StripeController::class, 'success']) -> name('success');

/*
|--------------------------------------------------------------------------
| Post Routes - StripeController
|--------------------------------------------------------------------------
*/

Route ::post('/checkout', [StripeController::class, 'checkout']) -> name('checkout');

/*
|--------------------------------------------------------------------------
| Get Routes - Mail
|--------------------------------------------------------------------------
*/

Route::get('/email/verify', function () {
    return view('auth.verify'); //create an email controller and pass to that
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); //pass to controller

    return redirect('/index');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');/**/
