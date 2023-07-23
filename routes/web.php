<?php

use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
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

//index
Route::get('/', [ListingController::class, 'index']);
//create
Route::get('/listings/create', [ListingController::class, 'create']);
//store listing post
Route::post('/listings', [ListingController::class, 'store']);






//show
Route::get('/listings/{listing}', [ListingController::class, 'show']);