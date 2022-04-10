<?php

use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/users', [UserController::class, 'store']);
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/auth'

], function ($router) {
    Route::post('login', [\App\Http\Controllers\api\AuthController::class, 'login'])->name('login');
    Route::post('logout', [\App\Http\Controllers\api\AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [\App\Http\Controllers\api\AuthController::class, 'refresh'])->name('refresh');
    Route::post('me', [\App\Http\Controllers\api\AuthController::class, 'me'])->name('me');
});



Route::group(['middleware' => ['jwt.verify']], function() {
    Route::prefix('v1')->group(function () {
        Route::prefix('posts')->group(function () {
            Route::get('/', [PostController::class, 'index']);
            Route::post('/', [PostController::class, 'store']);
            Route::get('/{post_id}', [PostController::class, 'show']);
        });
        Route::prefix('videos')->group(function () {
            Route::get('/', [VideoController::class, 'index']);
            Route::post('/', [VideoController::class, 'store']);
        });
    });
});
