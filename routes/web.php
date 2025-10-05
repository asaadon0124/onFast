<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UsersController;
use App\Http\Controllers\User\rebortsController;
use App\Http\Controllers\User\productsController;
use App\Http\Controllers\UserS\forgetPasswordController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () 
{
    return view('welcome');
})->name('welcome');

Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::prefix('users')->middleware('guest:web')->group(function()
{
    // FORGET PASSWORD
    Route::get('/forgetPassword', [forgetPasswordController::class, 'forgetPasswordUser'])->name('forgetPassword.User');
    Route::post('/forgetPassword', [forgetPasswordController::class, 'sendEmail'])->name('forgetPassword.post.User');
    Route::get('/reset-password/{token}', [forgetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('/reset-password', [forgetPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    Route::get('/contactUs', [UsersController::class, 'contactUs'])->name('user.contactUs');

});



Route::prefix('users')->middleware('auth:web')->group(function()
{
    Route::get('/packageDetailes/{id}', [UsersController::class, 'packageDetailes'])->name('user.packageDetailes');
    Route::get('/showData', [UsersController::class, 'showData'])->name('user.showData');
    Route::get('/filter', [UsersController::class, 'filter'])->name('user.filter');
    Route::get('/profile', [UsersController::class, 'profile'])->name('user.profile');
    Route::post('/profile/update', [UsersController::class, 'updateProfile'])->name('user.profile.update');


    Route::get('/index_product', [productsController::class, 'index'])->name('user.index.product');
    Route::get('/create_product', [productsController::class, 'create'])->name('user.create.product');
    Route::get('/cities/{id}', [productsController::class, 'cities'])->name('cities');
    Route::post('/create_product', [productsController::class, 'store'])->name('store.create.product');
    Route::get('/edit_product/{id}', [productsController::class, 'edit'])->name('user.edit.product');
    Route::post('/update_product/{id}', [productsController::class, 'update'])->name('user.update.product');
    Route::delete('/delete_product/{id}', [productsController::class, 'delete_product'])->name('user.delete_product.product');



    // Route::get('logout','Auth\LoginController@logout')->name('user.logout');
    // Route::get('/packageDetailes/{id}', 'User\UsersController@packageDetailes')->name('user.packageDetailes');
    // Route::get('/showData', 'User\UsersController@showData')->name('user.showData');
    // Route::get('/filter', 'User\UsersController@filter')->name('user.filter');
    // Route::get('/profile', 'User\UsersController@profile')->name('user.profile');
    // Route::post('/profile/update', 'User\UsersController@updateProfile')->name('user.profile.update');

    // Route::get('/index_product', 'User\productsController@index')->name('user.index.product');
    // Route::get('/create_product', 'User\productsController@create')->name('user.create.product');
    // Route::get('cities/{id}','User\productsController@cities')->name('Cities');
    // Route::post('/create_product', 'User\productsController@store')->name('store.create.product');
    // Route::get('/edit_product/{id}', 'User\productsController@edit')->name('user.edit.product');
    // Route::post('/update_product/{id}', 'User\productsController@update')->name('user.update.product');
    // Route::delete('/delete_product/{id}', 'User\productsController@delete')->name('user.delete.product');
    
      Route::prefix('reborts')->group(function()
    {
        Route::get('/index_product', [rebortsController::class, 'index'])->name('user.index.reborts');
        Route::post('/search_product', [rebortsController::class, 'search'])->name('user.search.reborts');
    });


});



Route::get('reset/password/{token}', [ResetPasswordController::class, 'ResetsPasswords']);

// Route::get('reset/password/{token}','Auth\ResetPasswordController@ResetsPasswords');

// Route::get('/dashboard', function () 
// {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () 
// {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
