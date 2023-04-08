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
Route::get('/sub-category', [App\Http\Controllers\CategoryController::class, 'sub_cat_index'])->name('sub.category');
Route::post('categoryformSubmit', [App\Http\Controllers\CategoryController::class, 'categoryformSubmit']);  
Route::post('subcategoryformSubmit', [App\Http\Controllers\CategoryController::class, 'subcategoryformSubmit']);  
Route::get('show-category', [App\Http\Controllers\CategoryController::class, 'showcategory'])->name('show.category');  
Route::get('show-sub-category', [App\Http\Controllers\CategoryController::class, 'showsubcategory'])->name('show.sub.category');  
Route::get('return-category', [App\Http\Controllers\CategoryController::class, 'returncategory']);  
Route::get('return-sub-category', [App\Http\Controllers\CategoryController::class, 'returnsubcategory']);  
Route::get('category-delete/{id}', [App\Http\Controllers\CategoryController::class, 'category_delete']);  
Route::get('sub-category-delete/{id}', [App\Http\Controllers\CategoryController::class, 'sub_category_delete']);  
Route::get('edit-return-category/{id}', [App\Http\Controllers\CategoryController::class, 'category_edit']);  
Route::get('edit-return-sub-category/{id}', [App\Http\Controllers\CategoryController::class, 'sub_category_edit']);  
Route::post('category-update', [App\Http\Controllers\CategoryController::class, 'category_update']);  
