<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/Add-Center', [App\Http\Controllers\HomeController::class, 'add_center'])->name('Add-Center');

Route::post('/Add-Center', [App\Http\Controllers\HomeController::class, 'add']);

Route::post('/image-upload', [App\Http\Controllers\HomeController::class, 'upload'])->name('image-upload');
Route::post('image-delete', [App\Http\Controllers\HomeController::class, 'delete'])->name('image-delete');
Route::post('fetch-image', [App\Http\Controllers\HomeController::class, 'fetch_image'])->name('image-fetch');


Route::delete('/center/{id}', [App\Http\Controllers\HomeController::class, 'destroy']);
Route::get('/center/{id}', [\App\Http\Controllers\HomeController::class, 'show']); 

Route::get('/center/{id}/edit', [\App\Http\Controllers\HomeController::class, 'edit']); 
Route::put('/center/{id}/edit', [\App\Http\Controllers\HomeController::class, 'update']);


Route::get('settings', [\App\Http\Controllers\HomeController::class, 'settings'])->name('setting'); 

Route::Post('settings', [\App\Http\Controllers\HomeController::class, 'changesetting']); 



// Route::post('files', [\App\Http\Controllers\HomeController::class, 'save'])->name('file.store');
// Route::post('files/remove', [\App\Http\Controllers\HomeController::class, 'update'])->name('file.remove');
