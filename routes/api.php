<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/clear', function() {

    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('route:cache');

    return "Cleared!";
});

Route::get('test', [\App\Http\Controllers\DownloadController::class, 'makeData']);

Route::post('register', [\App\Http\Controllers\UserController::class, 'register']);
Route::post('login', [\App\Http\Controllers\UserController::class, 'login']);

Route::middleware(['auth:api', 'json.response'])->group(function () {
    Route::prefix('photo')->group(function () {
        Route::get('/', [\App\Http\Controllers\PhotoController::class, 'index']);
        Route::get('discover', [\App\Http\Controllers\PhotoController::class, 'discover']);

    });
});
