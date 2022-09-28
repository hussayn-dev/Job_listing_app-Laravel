<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ListingController;




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

Route::get('/',  [ListingController::class, 'index']);

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Store Listing Data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');    

Route::get('/listings/{listing}/edit',[ListingController::class, 'edit'])->middleware('auth');
Route::put('/listings/{listing}',    [ListingController::class, 'update'])->middleware('auth');



// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

Route::get('/register' , [UserController::class, 'create'])->middleware('guest');
Route::post('/users', [UserController::class, 'store']);
Route::get('/login', [UserController::class, 'login'])->name('login')
->middleware('guest');
Route::post('/users/authenticate', [UserController::class, 'authenticate']);


Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');