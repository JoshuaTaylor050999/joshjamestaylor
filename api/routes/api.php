<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PortfolioController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/blogs/latest', [BlogController::class, 'latest']);
Route::apiResource('blogs', BlogController::class);

Route::get('/portfolios/latest', [PortfolioController::class, 'latest']);
Route::apiResource('portfolios', PortfolioController::class);

Route::post('/contact',[ContactController::class,'store']);