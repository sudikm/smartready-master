<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);
    Route::get('/register', ['as' => 'registerView', 'uses' => 'HomeController@registerView']);
    Route::post('/registerUser', ['as' => 'registerUser', 'uses' => 'HomeController@registerUser']);
    Route::get('/help', ['as' => 'help', 'uses' => 'HomeController@help']);
    Route::get('/join', ['as' => 'join', 'uses' => 'HomeController@join']);
    Route::get('/scan', ['as' => 'scan', 'uses' => 'HomeController@scan']);
    Route::post('/scanSubmit', ['as' => 'scanSubmit', 'uses' => 'HomeController@scanSubmit']);
    Route::get('/confirm/{type}/{pin}', ['as' => 'confirmSms', 'uses' => 'HomeController@confirmRegister']);

    /**
     *  Admin group
     */
   

    Route::get('/admin', ['as' => 'login', 'uses' => 'AdminController@login']);
    Route::post('/verifyLogin', ['as' => 'verifyLogin', 'uses' => 'AdminController@verifyLogin']);

    Route::group(['middleware' => ['isadmin']], function () {
        /**
         *  Admin User
         */
        Route::get('/admin/logoutAdminUser', ['as' => 'logoutAdminUser', 'uses' => 'AdminController@logoutAdminUser']);
        Route::get('/admin/dashboard', ['as' => 'dashboard', 'uses' => 'AdminController@dashboard']);
        Route::get('/admin/listAdminUser', ['as' => 'listAdminUser', 'uses' => 'AdminController@listAdminUser']);
        Route::get('/admin/addAdminUser', ['as' => 'addAdminUser', 'uses' => 'AdminController@addAdminUser']);
        Route::post('/admin/saveAdminUser', ['as' => 'saveAdminUser', 'uses' => 'AdminController@saveAdminUser']);
        Route::get('/admin/editAdminUser/{id}', ['as' => 'editAdminUser', 'uses' => 'AdminController@editAdminUser']);
        Route::post('/admin/updateAdminUser/{id}', ['as' => 'updateAdminUser', 'uses' => 'AdminController@updateAdminUser']);
        Route::get('/admin/deleteAdminUser/{id}', ['as' => 'deleteAdminUser', 'uses' => 'AdminController@deleteAdminUser']);
 
        /**
         *  Products
         */
        Route::get('/admin/listProduct', ['as' => 'listProduct', 'uses' => 'ProductController@listProduct']);
        Route::get('/admin/addProduct', ['as' => 'addProduct', 'uses' => 'ProductController@addProduct']);
        Route::post('/admin/saveProduct', ['as' => 'saveProduct', 'uses' => 'ProductController@saveProduct']);
        Route::get('/admin/editProduct/{id}', ['as' => 'editProduct', 'uses' => 'ProductController@editProduct']);
        Route::post('/admin/updateProduct/{id}', ['as' => 'updateProduct', 'uses' => 'ProductController@updateProduct']);
        Route::get('/admin/deleteProduct/{id}', ['as' => 'deleteProduct', 'uses' => 'ProductController@deleteProduct']);
    });

});
// for REST APIS

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->post('qrCodeProduct', 'App\Http\Controllers\RestController@qrCodeProduct');
});