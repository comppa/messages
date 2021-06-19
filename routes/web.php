<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

Route::get('/message', [App\Http\Controllers\MessageController::class, 'create'])->name('message.create');

Route::post('/message', [App\Http\Controllers\MessageController::class, 'store'])->name('store');

Route::post('/webhooks/status', [App\Http\Controllers\MessageController::class, 'status'])->name('message.status');

Route::post('/webhooks/inbound', [App\Http\Controllers\MessageController::class, 'inbound'])->name('inbound');
