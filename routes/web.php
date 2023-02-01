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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/home', [TodoController::class,'index']);
Route::post('/todos/create',[TodoController::class,'store']);
Route::post('/todos/delete',[TodoController::class,'destroy'])->name('todo.destroy');
Route::post('/todos/update',[TodoController::class,'update'])->name('todo.update');

