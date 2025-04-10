<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Servant\homeController;

/*
|--------------------------------------------------------------------------
| Servant Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// *********************** START AUTH ********************************************************
Route::prefix('servant')->middleware('guest:servant')->group(function()
{
    // FORGET PASSWORD 
    Route::get('/login', [homeController::class, 'login'])->name('servant.login');
    Route::post('/makeLogin', [homeController::class, 'makeLogin'])->name('servant.makeLogin');   
   
});
// *********************** END AUTH **********************************************************




Route::prefix('servant')->namespace('Servant')->middleware('auth:servant')->group(function()
{
    Route::get('/Dashboard', [homeController::class, 'home'])->name('servant.home');
    Route::get('/allOrders', [homeController::class, 'allOrders'])->name('servant.allOrders');
    Route::get('/showOrderDetailes/{id}', [homeController::class, 'showOrderDetailes'])->name('servant.showOrderDetailes');
    Route::get('/logout', [homeController::class, 'logout'])->name('servant.logout');

});

