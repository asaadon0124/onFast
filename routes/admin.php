<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\adminsController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\ordersController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReturnsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\RebortesController;
use App\Http\Controllers\Admin\reservesController;
use App\Http\Controllers\Admin\ServantsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SuppliersController;
use App\Http\Controllers\Admin\governoratesController;
use App\Http\Controllers\Admin\orderDetailesController;

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

// Note That The Prefix [admin] For All Routes In This File

Route::prefix('admin')->group(function()
{
    Route::middleware('auth:admin')->group(function()
{

    // ************************************** START DASHBOARD ROUTES ************************
        Route::get('/Dashboard', [DashboardController::class, 'index'])->name('Dashboard');
        Route::post('/payMony', [DashboardController::class, 'payMony'])->name('Dashboard.payMony');
        Route::get('/endStatus/{id}', [DashboardController::class, 'endStatus'])->name('Dashboard.endStatus');
        Route::get('/restore1/{id}', [DashboardController::class, 'restore1'])->name('Dashboard.restore1');
        Route::get('/restore2/{id}', [DashboardController::class, 'restore2'])->name('Dashboard.restore2');
        Route::get('/history', [DashboardController::class, 'history'])->name('Dashboard.history');
        Route::get('/filter', [DashboardController::class, 'filter'])->name('Dashboard.filter');
        Route::get('/filter2', [DashboardController::class, 'filter2'])->name('Dashboard.filter2');
        Route::get('/notes', [DashboardController::class, 'notes'])->name('Dashboard.notes');
        Route::get('/test', [DashboardController::class, 'test'])->name('test');
        Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    // ************************************** END DASHBOARD ROUTES ************************



    // ************************************** START ADMIN ROUTES ************************
    Route::prefix('admins')->group(function()
    {
        Route::get('/', [adminsController::class, 'index'])->name('admins.index');
        Route::post('/store', [adminsController::class, 'store'])->name('admins.store');
        Route::get('/edit/{id}', [adminsController::class, 'edit'])->name('admins.edit');
        Route::put('/update/{id}', [adminsController::class, 'update'])->name('admins.update');
        Route::post('/destroy', [adminsController::class, 'destroy'])->name('admins.destroy');

    });
    // ************************************** END ADMIN ROUTES ************************


    // ************************************** START PERMISSIONS ROUTES ************************
    Route::prefix('permissions')->group(function()
    {
        Route::get('/','PermissionsController@index')->name('permissions.index');
        Route::post('/store','PermissionsController@store')->name('permissions.store');
        Route::get('/edit/{id}','PermissionsController@edit')->name('permissions.edit');
        Route::PUT('/update/{id}','PermissionsController@update')->name('permissions.update');
        Route::post('/destroy','PermissionsController@destroy')->name('permissions.destroy');
    });
    // ************************************** END PERMISSIONS ROUTES ************************


    // ************************************** START ROLES ROUTES ************************
    Route::prefix('roles')->group(function()
    {
        Route::get('/','rolesController@index')->name('roles.index');
        Route::post('/store','rolesController@store')->name('roles.store');
        Route::get('/edit/{id}','rolesController@edit')->name('roles.edit');
        Route::PUT('/update/{id}','rolesController@update')->name('roles.update');
        Route::post('/destroy','rolesController@destroy')->name('roles.destroy');
    });
    // ************************************** END ROLES ROUTES ************************


    // ************************************** START PROFILE ROUTES ************************
    Route::prefix('profile')->group(function()
    {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('pro.edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('pro.update');
        Route::get('/change_password', [ProfileController::class, 'change_password'])->name('pro.change_password');
        Route::post('/make_change_password', [ProfileController::class, 'make_change_password'])->name('pro.make_change_password');

    });
    // ************************************** END PROFILE ROUTES ************************


    // ************************************** START SERVANTS ROUTES ************************
    Route::prefix('servants')->group(function()
    {
        Route::get('/', [ServantsController::class, 'index'])->name('servants.index');
        Route::get('/create', [ServantsController::class, 'create'])->name('servants.create');
        Route::post('/store', [ServantsController::class, 'store'])->name('servants.store');
        Route::get('/edit/{id}', [ServantsController::class, 'edit'])->name('servants.edit');
        Route::post('/update/{id}', [ServantsController::class, 'update'])->name('servants.update');
        Route::post('/destroy', [ServantsController::class, 'destroy'])->name('servants.destroy');
        Route::get('/getSoftDelete', [ServantsController::class, 'getSoftDelete'])->name('servants.getSoftDelete');
        Route::get('/restore', [ServantsController::class, 'restore'])->name('servants.restore');
    });
    // ************************************** END SERVANTS ROUTES ************************


    // ************************************** START ORDER STATUS ROUTES ************************
    Route::prefix('status')->group(function()
    {
        Route::get('/', [StatusController::class, 'index'])->name('status.index');
        Route::post('/store', [StatusController::class, 'store'])->name('status.store');
        Route::get('/edit/{id}', [StatusController::class, 'edit'])->name('status.edit');
        Route::post('/update/{id}', [StatusController::class, 'update'])->name('status.update');
        Route::post('/destroy', [StatusController::class, 'destroy'])->name('status.destroy');
        Route::get('/getSoftDelete', [StatusController::class, 'getSoftDelete'])->name('status.getSoftDelete');
        Route::get('/restore', [StatusController::class, 'restore'])->name('status.restore');
    });
    // ************************************** END ORDER STATUS ROUTES ************************


    // ************************************** START GOVERNORATES ROUTES ************************
    Route::prefix('governorates')->group(function()
    {
        Route::get('/', [governoratesController::class, 'index'])->name('governorates.index');
        Route::post('/store', [governoratesController::class, 'store'])->name('governorates.store');
        Route::get('/edit/{id}', [governoratesController::class, 'edit'])->name('governorates.edit');
        Route::post('/update/{id}', [governoratesController::class, 'update'])->name('governorates.update');
        Route::post('/destroy', [governoratesController::class, 'destroy'])->name('governorates.destroy');
        Route::get('/getSoftDelete', [governoratesController::class, 'getSoftDelete'])->name('governorates.getSoftDelete');
        Route::get('/restore', [governoratesController::class, 'restore'])->name('governorates.restore');
    });
    // ************************************** END GOVERNORATES ROUTES ************************


    // ************************************** START CITIES ROUTES ************************
    Route::prefix('cities')->group(function()
    {
        Route::get('/', [CitiesController::class, 'index'])->name('cities.index');
        Route::post('/store', [CitiesController::class, 'store'])->name('cities.store');
        Route::get('/edit/{id}', [CitiesController::class, 'edit'])->name('cities.edit');
        Route::post('/update/{id}', [CitiesController::class, 'update'])->name('cities.update');
        Route::post('/destroy', [CitiesController::class, 'destroy'])->name('cities.destroy');
        Route::get('/getSoftDelete', [CitiesController::class, 'getSoftDelete'])->name('cities.getSoftDelete');
        Route::get('/restore', [CitiesController::class, 'restore'])->name('cities.restore');

    });
    // ************************************** END CITIES ROUTES ************************


    // ************************************** START SUPPLIERS ROUTES ************************
    Route::prefix('suppliers')->group(function()
    {
        Route::get('/', [SuppliersController::class, 'index'])->name('suppliers.index');
        Route::get('/create', [SuppliersController::class, 'create'])->name('suppliers.create');
        Route::post('/store', [SuppliersController::class, 'store'])->name('suppliers.store');
        Route::get('/edit/{id}', [SuppliersController::class, 'edit'])->name('suppliers.edit');
        Route::post('/update/{id}', [SuppliersController::class, 'update'])->name('suppliers.update');
        Route::post('/destroy', [SuppliersController::class, 'destroy'])->name('suppliers.destroy');
        Route::get('/getSoftDelete', [SuppliersController::class, 'getSoftDelete'])->name('suppliers.getSoftDelete');
        Route::get('/restore', [SuppliersController::class, 'restore'])->name('suppliers.restore');
        Route::get('/cities/{id}', [SuppliersController::class, 'cities'])->name('cities');

    });
    // ************************************** END SUPPLIERS ROUTES ************************


    // ************************************** START PRODUCTS ROUTES ************************
    Route::prefix('products')->group(function()
    {
        Route::get('/', [ProductsController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductsController::class, 'create'])->name('products.create');
        Route::post('/store', [ProductsController::class, 'store'])->name('products.store');
        Route::get('/show/{id}', [ProductsController::class, 'show'])->name('products.show');
        Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
        Route::post('/update/{id}', [ProductsController::class, 'update'])->name('products.update');
        Route::post('/destroy', [ProductsController::class, 'destroy'])->name('products.destroy');
        Route::get('/getSoftDelete', [ProductsController::class, 'getSoftDelete'])->name('products.getSoftDelete');
        Route::get('/restore', [ProductsController::class, 'restore'])->name('products.restore');
        Route::get('/deletedProducts', [ProductsController::class, 'deletedProducts'])->name('products.deletedProducts');
        Route::get('/cities/{id}', [ProductsController::class, 'cities'])->name('cities');

        Route::get('/uncompleateProducts', [ProductsController::class, 'uncompleateProducts'])->name('products.uncompleateProducts');
        Route::get('/compleatedProducts', [ProductsController::class, 'compleatedProducts'])->name('products.compleatedProducts');

        Route::get('/newProducts', [ProductsController::class, 'newProducts_Index'])->name('products.newProducts_Index');
        Route::get('/newProducts_edit/{id}', [ProductsController::class, 'newProducts_edit'])->name('products.newProducts_edit');
        Route::post('/newProducts_update/{id}', [ProductsController::class, 'newProducts_update'])->name('products.newProducts_update');
        Route::post('/newProducts_accept', [ProductsController::class, 'newProducts_accept'])->name('products.newProducts_accept');

    });
    // ************************************** END PRODUCTS ROUTES ************************


    // ************************************** START ORDER DETAILES ROUTES ************************
    Route::prefix('orderDetailes')->group(function()
    {
        Route::get('/create', [orderDetailesController::class, 'create'])->name('orderDetailes.create');
        Route::get('/cities/{id}', [orderDetailesController::class, 'cities'])->name('cities');
        Route::post('/search', [orderDetailesController::class, 'search'])->name('orderDetailes.search');
        Route::post('/forceDelete/{id}', [orderDetailesController::class, 'forceDelete'])->name('orderDetailes.forceDelete');
        Route::post('/addToCart', [orderDetailesController::class, 'addToCart'])->name('orderDetailes.addToCart');
        Route::get('/submit_new_order', [orderDetailesController::class, 'submit_new_order'])->name('orderDetailes.submit_new_order');
        Route::post('/changeStatus', [orderDetailesController::class, 'changeStatus'])->name('orderDetailes.changeStatus');
        Route::post('/changeShippingPrice', [orderDetailesController::class, 'changeShippingPrice'])->name('orderDetailes.changeShippingPrice');

        Route::get('/filter', [orderDetailesController::class, 'filter'])->name('orderDetailes.filter');
        Route::post('/deleteProduct', [orderDetailesController::class, 'deleteProduct'])->name('orderDetailes.deleteProduct');

        // Route::get('/create','orderDetailesController@create')->name('orderDetailes.create');
        // Route::get('cities/{id}','orderDetailesController@cities')->name('Cities');
        // Route::post('search/','orderDetailesController@search')->name('orderDetailes.search');
        // Route::post('forceDelete/{id}','orderDetailesController@forceDelete')->name('orderDetailes.forceDelete');  // DELETE ITEMS FROM ORDER DETAILES TABLE IF I DON,T CREATED NEW ORDER
        // Route::post('addToCart/','orderDetailesController@addToCart')->name('orderDetailes.addToCart');
        // Route::get('submit_new_order/','orderDetailesController@submit_new_order')->name('orderDetailes.submit_new_order');
        // Route::post('changeStatus/','orderDetailesController@changeStatus')->name('orderDetailes.changeStatus');
        // Route::post('changeShippingPrice/','orderDetailesController@changeShippingPrice')->name('orderDetailes.changeShippingPrice');

        // Route::get('/filter', 'orderDetailesController@filter')->name('orderDetailes.filter');
        // Route::post('deleteProduct/','orderDetailesController@deleteProduct')->name('orderDetailes.deleteProduct');


    });
    // ************************************** END ORDER DETAILES ROUTES ************************


// ************************************** START ORDERS  ROUTES ************************
Route::prefix('orders')->group(function()
{
    Route::get('/index', [ordersController::class, 'index'])->name('orders.index');
    Route::post('/changeServant/{id}', [ordersController::class, 'changeServant'])->name('orders.changeServant');
    Route::post('/store', [ordersController::class, 'store'])->name('orders.store');
    Route::get('/edit/{id}', [ordersController::class, 'edit'])->name('orders.edit');
    Route::get('/show/{id}', [ordersController::class, 'show'])->name('orders.show');
    Route::post('/changeStatus', [ordersController::class, 'changeStatus'])->name('orders.changeStatus');
    Route::get('/softDelete', [ordersController::class, 'softDelete'])->name('orders.softDelete');
    Route::get('/restore', [ordersController::class, 'restore'])->name('orders.restore');
    Route::get('/show_order_detailes/{id}', [ordersController::class, 'show_order_detailes'])->name('orders.show_order_detailes');
    Route::post('/productNote/{id}', [ordersController::class, 'productNote'])->name('orders.productNote');
    Route::get('/addProduct/{id}', [ordersController::class, 'addProduct'])->name('orders.addProduct.get');
    Route::post('/addProduct', [ordersController::class, 'StoreProduct'])->name('orders.addProduct.post');
    Route::get('/forceDeleteItem/{id}', [ordersController::class, 'forceDeleteItem'])->name('orders.forceDeleteItem');

    // EDIT ORDER DETAILES

    Route::get('/editOrderItem/{id}', [ordersController::class, 'editOrderItem'])->name('orders.editOrderItem');
    Route::post('/updateOrderItem/{id}', [ordersController::class, 'updateOrderItem'])->name('orders.updateOrderItem');
    Route::get('/deleteOrder/{id}', [ordersController::class, 'deleteOrder'])->name('orders.deleteOrder');
    Route::post('/profit', [ordersController::class, 'profit'])->name('orders.profit');
    Route::post('/restoreReturns', [ordersController::class, 'restoreReturns'])->name('orders.restoreReturns');


    // Route::get('index','ordersController@index')->name('orders.index');                                                         // SHOW ALL ORDERS [ORDERS - RETURNS]
    // Route::post('changeServant/{id}','ordersController@changeServant')->name('orders.changeServant');                           // CHANGE SERVANT ID IN ORDER TABLE
    // Route::post('store','ordersController@store')->name('orders.store');                                                        // CREATE NEW ORDER AND UPDATE ORDER_ID IN ORDER DETAILES TABLE
    // Route::get('edit/{id}','ordersController@edit')->name('orders.edit');                                                       // UPDATE ORDER STATUS TO COMPLETED
    // Route::get('show/{id}','ordersController@show')->name('orders.show');                                                       // SHOW ITEMS OF ORDER PAGE
    // Route::post('changeStatus','ordersController@changeStatusItems')->name('orders.changeStatus');                              // CHANGE STATUS OF ITEMS OF ORDER
    // Route::get('softDelete','ordersController@softDelete')->name('orders.softDelete');                                          // TO SHOW ALL ORDER COMBLETED
    // Route::get('restore','ordersController@restore')->name('orders.restore');                                                   // RESTORE ORDER TO UNCOMPLEATED ORDER PAGE
    // Route::get('show_order_detailes/{id}','ordersController@show_order_detailes')->name('orders.show_order_detailes');          // TO SHOW ORDER DETAILES IN ORDER COMPLEATED PAGE
    // Route::post('productNote/{id}','ordersController@productNote')->name('orders.productNote');                                 // UPDATE NOTE TO PRODUCT IN PRODUCTS TABLE AND ORDER DETAILES TABLE
    // Route::get('addProduct/{id}','ordersController@addProduct')->name('orders.addProduct.get');                                 // SHOW ADD NEW PRODUCT TO ORDER  PAGE
    // Route::post('addProduct','ordersController@StoreProduct')->name('orders.addProduct.post');                                  // UPDATE NEW PRODUCT TO ORDER PAGE
    // Route::get('forceDeleteItem/{id}','ordersController@forceDeleteItem')->name('orders.forceDeleteItem');                      // DELETE ITEM FROM ORDER AND RETURN IT TO PRODUCTS TABLE  [AS A ORDER DETAILES]
    // EDIT ORDER DETAILES
    // Route::get('editOrderItem/{id}','ordersController@editOrderItem')->name('orders.editOrderItem'); //to show edit item page
    // Route::post('updateOrderItem/{id}','ordersController@updateOrderItem')->name('orders.updateOrderItem'); //to update item Detailes
    // Route::get('deleteOrder/{id}','ordersController@deleteOrder')->name('orders.deleteOrder'); //to update item Detailes
    // Route::post('profit/','ordersController@profit')->name('orders.profit');                                                    //CREATE COMPANY
    // Route::post('restoreReturns','ordersController@restoreReturns')->name('orders.restoreReturns');                         //RESTORE RETURNS ITEMS

    // PROFIT

});
// ************************************** END ORDERS ROUTES ************************


// ************************************** START RESERVES ROUTES ************************
 Route::prefix('reserves')->group(function()
 {
    Route::get('/', [reservesController::class, 'index'])->name('reserves.index');
    Route::get('/create', [reservesController::class, 'create'])->name('reserves.create');
    Route::post('/search', [reservesController::class, 'search'])->name('reserves.search');
    Route::post('/addToCart', [reservesController::class, 'addToCart'])->name('reserves.addToCart');
    Route::post('/store', [reservesController::class, 'store'])->name('reserves.store');
    Route::get('/show/{id}', [reservesController::class, 'show'])->name('reserves.show');

    Route::get('/edit/{id}', [reservesController::class, 'edit'])->name('reserves.edit');
    Route::post('/update/{id}', [reservesController::class, 'update'])->name('reserves.update');
    Route::post('/destroy', [reservesController::class, 'destroy'])->name('reserves.destroy');


 });
 // ************************************** END RESERVES ROUTES ************************


// ************************************** START RETURNS  ROUTES ************************
Route::prefix('returns')->group(function()
{
    Route::get('/index', [ReturnsController::class, 'index'])->name('returns.index');
    Route::get('/softDelete', [ReturnsController::class, 'softDelete'])->name('returns.softDelete');
    Route::get('/restore', [ReturnsController::class, 'restore'])->name('returns.restore');

});
// ************************************** END RETURNS ROUTES ************************


// ************************************** START REBORTS ROUTES ************************
    Route::prefix('reborts')->group(function()
    {

        Route::get('/index', [RebortesController::class, 'index'])->name('reborts.index');
        Route::get('/allProducts', [RebortesController::class, 'allProducts'])->name('reborts.allProducts');
        Route::post('/add/day', [RebortesController::class, 'setday']);
        Route::post('/add/dayy1', [RebortesController::class, 'oneday']);

         // SERVANTS REBORTS
        Route::get('/servantindex', [RebortesController::class, 'servantindex'])->name('reborts.servantindex');
        Route::post('/add/day1', [RebortesController::class, 'servantname'])->name('servant');
        Route::get('/showMore/{id}', [RebortesController::class, 'showMore'])->name('reborts.showMore');

        // SUPPLIER REBORTS
        Route::get('/getCastomer_index', [RebortesController::class, 'getCastomer_index'])->name('reborts.castomerIndex');
        // Route::post('/getCastomer_reborts', [RebortesController::class, 'getCastomer_reborts'])->name('reborts.getCastomer_reborts');

        Route::get('/orderNumber_index', [RebortesController::class, 'orderNumber_index'])->name('reborts.orderNumber_index');
        Route::post('/orderNumber_reborts', [RebortesController::class, 'orderNumber_reborts'])->name('reborts.orderNumber_reborts');

        Route::get('/completeProduct/{id}', [RebortesController::class, 'completeProduct'])->name('reborts.completeProduct');
        // Route::get('/test', function() {
        //     return view('admin.layouts.master');
        // });
    });


    // ************************************** END REBORTS ROUTES ************************
});

Route::middleware('guest:admin')->group(function()
    {
        // Route::get('/login','LoginController@loginForm')->name('admin.login');
        Route::get('/login', [LoginController::class, 'loginForm'])->name('admin.login');
        Route::post('/makelogin', [LoginController::class, 'login'])->name('admin.MakeLogin');
    });
});







