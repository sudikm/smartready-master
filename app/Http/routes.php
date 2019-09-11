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


    Route::get('/register', ['as' => 'register', 'uses' => 'HomeController@register']);

    Route::get('/register/sector', function () {
    return view('register.sector'); 
    });

    Route::get('/register/email', function () {
        return view('register.email');
    });

    Route::post('/register/register_email', ['as' => 'register_email', 'uses' => 'HomeController@register_email']);

    Route::get('/register/name', function () {
        return view('register.name');
    });

    Route::get('/register/thanks', function () {
    return view('register.thanks');
    });



    Route::get('/search/pin', function () {
    return view('search.pin');
    });
    Route::get('/search/company', function () {
    return view('search.company');
    });
    Route::get('/search/location', function () {
    return view('search.location');
    });
    Route::group(['prefix' => 'search'], function () {
        Route::get('/company/result', function () {
            return view('search.result');
        });
        Route::get('/location/result', function () {
            return view('search.result');
        });
        Route::get('/category/result', function () {
            return view('search.result');
        });
    });


    Route::get('/number/0000/', function () {return view('number.0000.buy');/*view('number.0000.index');*/ });
    // Route::get('/number/0000/buy', function () {return view('number.0000.buy');});

    Route::get('/number/1111/', function () {return view('number.1111.buy');/*view('number.1111.index');*/ });
    // Route::get('/number/1111/buy', function () {return view('number.1111.buy');});
    Route::get('/number/1111/switch', function () {return view('number.1111.switch_1111'); });

    Route::get('/number/2222/', function () {return view('number.2222.buy');/*view('number.2222.index');*/ });
    // Route::get('/number/2222/buy', function () {return view('number.2222.buy');});

    Route::get('/number/3333/', function () {return view('number.3333.buy');/*view('number.3333.index');*/ });
    // Route::get('/number/3333/buy', function () {return view('number.3333.buy');});

    Route::get('/number/4444/', function () {return view('number.4444.buy');/*view('number.4444.index');*/ });
    // Route::get('/number/4444/buy', function () {return view('number.4444.buy');});



    Route::get('/app', ['as' => 'app', 'uses' => 'HomeController@app']);
    Route::get('/app/send', ['as' => 'send', 'uses' => 'HomeController@appsend']);

    Route::get('/business', ['as' => 'business', 'uses' => 'HomeController@business']);
    Route::get('/learn', ['as' => 'learn', 'uses' => 'HomeController@learn']);
    Route::get('/search', ['as' => 'search', 'uses' => 'HomeController@search']);
    Route::get('/swap', ['as' => 'swap', 'uses' => 'HomeController@swap']);


    Route::post('/sendApp', ['as' => 'sendApp', 'uses' => 'HomeController@sendApp']);
    Route::get('/confirm/{type}/{pin}', ['as' => 'confirmSms', 'uses' => 'HomeController@confirmRegister']);
    Route::post('/verify', ['as' => 'verify', 'uses' => 'HomeController@verify']);

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
