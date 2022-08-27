<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fb', [StockController::class, 'fbbutton']);
Route::get('/fblogin', [StockController::class, 'fblogin']);
Route::get('/fbres', [StockController::class, 'fbres']);
Route::get('/logout', [StockController::class, 'logout']);

Route::get('/stock', [StockController::class, 'stock']);
Route::get('/getStockPrice', [StockController::class, 'getStockPrice']);
