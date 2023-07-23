<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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


// Route::get('/hello', function () {
//     return response('hello')
//     ->header('Content-Type', 'text/plain');
// });

// Route::get('/user/{id}', function ($id) {
//     return response('<h1>current '. $id . '</h1>')
//     ->header('foo', 'bar');
// })->where('id', '[0-9]+');

// //request and query
// Route::get('/search', function(Request $request){
//     dd($request);
// });

//function method:
//index     R
//show      R
//create    C
//store     C
//edit      U
//update    U
//destroy   D


////LISTING
//index
Route::get('/', [ListingController::class, 'index']);
//create, when you want to post a job, just login and create
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');
//store listing post
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');
//show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');
//update submit
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');
//delete record
Route::delete('/listings/{listing}', [ListingController::class, 'delete'])->middleware('auth');
//show
Route::get('/listings/{listing}', [ListingController::class, 'show']);


////USER
//register, get method
Route::get('/users/register', [UserController::class, 'create'])->middleware('guest');
//register, create => post method
Route::post('/users/create', [UserController::class, 'store']);
//login, get method
Route::get('/users/login', [UserController::class, 'login'])->name('login')->middleware('guest');
//login, post method
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
//logout
Route::post('/users/logout', [UserController::class, 'logout'])->middleware('auth');
//manage List
Route::geT('/users/manage', [UserController::class, 'manage'])->middleware('auth');