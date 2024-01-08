<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('index');

// Auth::routes(['register' => false]);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/newtask', [App\Http\Controllers\HomeController::class, 'newtask'])->name('newtask');
Route::patch('/updatetask', [App\Http\Controllers\HomeController::class, 'updatetask'])->name('updatetask');
Route::delete('/deletetask', [App\Http\Controllers\HomeController::class, 'deletetask'])->name('deletetask');