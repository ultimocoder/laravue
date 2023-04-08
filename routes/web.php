<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category');
Route::post('categoryformSubmit', [App\Http\Controllers\CategoryController::class, 'categoryformSubmit']);  
Route::get('show-category', [App\Http\Controllers\CategoryController::class, 'showcategory'])->name('show.category');  
Route::get('return-category', [App\Http\Controllers\CategoryController::class, 'returncategory']);  
Route::get('category-delete/{id}', [App\Http\Controllers\CategoryController::class, 'category_delete']);  
