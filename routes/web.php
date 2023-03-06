<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
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
    return view('auth.register');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [TodoController::class,'index'])->name('home');
    Route::post('/todos/create',[TodoController::class,'store'])->name('todo.store');
    Route::post('/todos/delete',[TodoController::class,'destroy'])->name('todo.destroy');
    Route::post('/todos/update',[TodoController::class,'update'])->name('todo.update');
    Route::get('/todo/find', [TodoController::class,'find'])->name('todo.find');
    Route::get('/todo/search', [TodoController::class,'search'])->name('todo.search');
});

require __DIR__.'/auth.php';

