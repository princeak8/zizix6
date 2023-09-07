<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\ServiceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([
    'prefix' => 'v1',
    'namespace' => 'API'
], function () {
    Route::group([
        'prefix' => '/auth',
    ], function () {
        Route::post('/login', 'AuthController@login');
    });

    //Home
    Route::group([
        'middleware' => 'userauth',
    ], function () {
        Route::get('home', 'HomeController@home');
    });

    Route::group([
        'middleware' => 'userauth',
        'prefix' => '/clients'
    ], function () {
        Route::get('', 'ClientController@getClients');
        Route::get('/{id}', 'ClientController@getClient');
        Route::post('/save', 'ClientController@save');
    });
    
    //Services Route
    Route::group([
        'middleware' => 'userauth',
        'prefix' => '/services'
    ], function () {
        Route::get('', 'ServiceController@services');
        Route::post('/save', [ServiceController::class, 'save']);
    Route::post('/update', [ServiceController::class, 'update']);
    });

    Route::group([
        'middleware' => 'userauth'
    ], function () {
        Route::get('/parent_packages', 'PackageController@getParentPackages');
        Route::get('/package/{id}', 'PackageController@getPackage');
        Route::get('/package/{id}/services', 'PackageController@getPackageWithServices');
        Route::post('/save_parent_package', 'PackageController@saveParentPackage');
        Route::post('/save_package', 'PackageController@save');
        Route::post('/update_package', 'PackageController@update');
    });

    Route::group([
        'middleware' => 'userauth',
        'prefix' => 'package_service'
    ], function () {
        Route::post('/save', 'PackageServiceController@save');
        Route::post('/update', 'PackageServiceController@update');
        Route::get('/expiring', 'PackageServiceController@expiring');
        Route::get('/expired', 'PackageServiceController@expired');

    });
});

Route::group([
    'prefix' => '/services',
], function () {
    Route::get('/all', [ServiceController::class, 'services']);
});
