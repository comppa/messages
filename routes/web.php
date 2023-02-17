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

Route::post('/message', [App\Http\Controllers\MessageController::class, 'store'])->name('message.store');

Route::get('/link', [App\Http\Controllers\MessageController::class, 'link'])->name('message.link');


Route::post('/link', [App\Http\Controllers\MessageController::class, 'send_link'])->name('message.send_link');



Route::get('/image', [App\Http\Controllers\MessageController::class, 'image'])->name('message.link');


Route::post('/image', [App\Http\Controllers\MessageController::class, 'send_image'])->name('message.send_image');




Route::post('/webhooks', [App\Http\Controllers\MessageController::class, 'status'])->name('message.status');

Route::post('/webhooks/inbound', [App\Http\Controllers\MessageController::class, 'inbound'])->name('inbound');


Route::get('/importar', [App\Http\Controllers\ImportController::class, 'importExportView']);

Route::get('export', [App\Http\Controllers\ImportController::class, 'export'])->name('export');

Route::post('import', [App\Http\Controllers\ImportController::class, 'import'])->name('import');