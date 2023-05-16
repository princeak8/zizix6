<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\PackageServiceController as AdminPackageServiceController;

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

Route::get('/', [HomeController::class, 'index']);
Route::post('/send_message', [HomeController::class, 'save_contact_message']);




/*
	ADMIN ROUTES begins HERE
*/

Route::group([
    'prefix' => 'admin',
], function () {
    Route::get('/login', ['middleware' => 'guest', function() {
        return view('admin/login');
    }]);

    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/logout', [LoginController::class, 'logout']);

    Route::get('/register', function() {
        return view('register');
    });

    Route::post('/send_reset_link', 'Admin\ForgotPasswordController@send_reset_link');

    Route::get('/forgot_password', function() {
        return view('admin.passwords.email');
    });

    Route::get('/reset_link_sent', function() {
        return view('admin.passwords.reset_link_sent');
    });

    Route::get('/change_password/{token}', 'Admin\ForgotPasswordController@change_password_form');

    Route::post('/change_password', 'admin\ForgotPasswordController@change_password');

    Route::post('/register', 'Admin\RegisterController@create');

    Route::get('/', [AdminHomeController::class, 'index']);

    Route::get('/home', [AdminHomeController::class, 'index']);

    Route::group([
        'prefix' => '/services',
    ], function () {
        Route::get('/', [AdminServiceController::class, 'index']);
        Route::post('/save', [AdminServiceController::class, 'save']);
        Route::patch('/update', [AdminServiceController::class, 'update']);
        Route::delete('/delete/{id}', [AdminServiceController::class, 'delete'])->name('adminServices.destroy');
    });

    Route::group([
        'prefix' => '/clients',
    ], function () {
        Route::get('/', [AdminClientController::class, 'index']);
        Route::get('/add_client', [AdminClientController::class, 'add_client']);
        Route::get('/view/{id}', [AdminClientController::class, 'view']);
        Route::post('/save', [AdminClientController::class, 'save']);
        Route::patch('/update', [AdminClientController::class, 'update']);
        Route::delete('/delete/{id}', [AdminClientController::class, 'delete']);
    });

    Route::group([
        'prefix' => '/package',
    ], function () {
        Route::get('/view/{id}', [AdminPackageController::class, 'view']);
        Route::post('/update', [AdminPackageController::class, 'update']);
        Route::post('/save', [AdminPackageController::class, 'save']);
    });

    Route::group([
        'prefix' => '/package_service',
    ], function () {
        Route::post('/save', [AdminPackageServiceController::class, 'save']);
        Route::post('/update', [AdminPackageServiceController::class, 'update']);
        Route::get('/view/{id}', [AdminPackageServiceController::class, 'view']);
    });
    

    Route::get('/contact', 'Admin\PageController@contact');

    Route::post('/update_contact', 'Admin\PageController@update_contact');
});
