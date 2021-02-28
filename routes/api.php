<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PublicationController;

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

Route::post('/', function (Request $request) {
    return 'Hello and welcome to http pub sub';
} );

Route::post('/subscribe/{topic}', [SubscriptionController::class,'store' ]);
Route::post('/publish/{topic}', [PublicationController::class,'store' ]);
