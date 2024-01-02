<?php

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\PaymentController;


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

Route::get('/', [RoutingController::class, 'home'])->name('home');
Route::get('/home', [RoutingController::class, 'home'])->name('home');

Route::get('/about', [RoutingController::class, 'about'])->name('about');

//Route::get('/reviews', [RoutingController::class, 'reviews'])->name('reviews');

//Route::get('/buy', [RoutingController::class, 'buy'])->name('buy');

//Route::post('/session', [RoutingController::class, 'session'])->name('session');

Route::get('/contact', [RoutingController::class, 'contact'])->name('contact');

Auth::routes(['verify' => true]);
//Route::post('/login', [LoginController::class, 'login'])->name('login');
//Route::post('/register', [RegisterController::class, 'create'])->name('register');

Route::get('logout', [UserController::class, 'logout'])->name('logout');

//User  
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/profile/edit/{user}', [UserController::class, 'edit'])->name('profile.edit')->middleware('is_auth_user');
Route::put('/profile/{user}', [UserController::class, 'update'])->name('profile.update')->middleware('is_auth_user');
Route::post('/profile/destroy/{user}', [UserController::class, 'destroy'])->name('profile.destroy')->middleware('is_auth_user');

//Villager
Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('is_villager');
Route::get('/users/show/{user}', [UserController::class, 'show'])->name('users.show')->middleware('is_villager');
Route::post('/users/destroy/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('is_villager');
Route::get('/users/edit/{user}', [UserController::class, 'editUser'])->name('users.edit')->middleware('is_villager');
Route::put('/users/{user}', [UserController::class, 'updateUser'])->name('users.update')->middleware('is_villager');

//Type
Route::get('/types', [TypeController::class, 'index'])->name('types')->middleware('is_villager');
Route::get('/types/create', [TypeController::class, 'create'])->name('types.create')->middleware('is_villager');
Route::post('/types/destroy/{category}', [TypeController::class, 'destroy'])->name('types.destroy')->middleware('is_villager');
Route::post('/types', [TypeController::class, 'store'])->name('types.store')->middleware('is_villager');

//Spots
Route::get('/spots', [SpotController::class, 'index'])->name('spots');
Route::get('/spots/{user}', [SpotController::class, 'mySpots'])->name('mySpots')->middleware('is_auth_user');
Route::get('/spots/show/{spot}', [SpotController::class, 'show'])->name('spots.show');
Route::get('/spots/create/{user}', [SpotController::class, 'create'])->name('spots.create')->middleware('is_auth_user');
Route::get('/spots/edit/{spot}', [SpotController::class, 'edit'])->name('spots.edit')->middleware('is_spot_owner');
Route::post('/spots/destroy/{spot}', [SpotController::class, 'destroy'])->name('spots.destroy')->middleware('is_spot_owner');
Route::post('/spots', [SpotController::class, 'store'])->name('spots.store');
Route::post('/spots/{spot}', [SpotController::class, 'update'])->name('spots.update')->middleware('is_spot_owner');

Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('/search', [SpotController::class, 'search'])->name('search');
Route::get('/search/{order}', [SpotController::class, 'orderedSearch'])->name('search.order');

Route::post('/session', [StripeController::class, 'session'])->name('session');
Route::get('/success', [StripeController::class, 'success'])->name('success');
Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel');
 
Route::get('/cart', [SpotController::class, 'cart'])->name('cart');
Route::post('/add-to-cart/{id}', [SpotController::class, 'addToCart'])->name('add_to_cart');
Route::post('/update-cart', [SpotController::class, 'updateCart'])->name('update_cart');
Route::post('/remove-from-cart', [SpotController::class, 'removeCart'])->name('remove_from_cart');
