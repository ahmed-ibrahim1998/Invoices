<?php

use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

//Auth::routes(['register'=>false]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('invoices', 'App\Http\Controllers\InvoicesController');
Route::resource('sections', 'App\Http\Controllers\SectionsController');
Route::resource('products', 'App\Http\Controllers\ProductsController');
Route::get('/section/{id}', [App\Http\Controllers\InvoicesController::class, 'getproducts']);
Route::get('/InvoicesDetails/{id}', [App\Http\Controllers\InvoicesDetailsController::class, 'edit']);

Route::get('download/{invoice_number}/{file_name}', [App\Http\Controllers\InvoicesDetailsController::class,'get_file']);

Route::get('View_file/{invoice_number}/{file_name}',  [App\Http\Controllers\InvoicesDetailsController::class,'open_file']);

Route::post('delete_file', [App\Http\Controllers\InvoicesDetailsController::class,'destroy'])->name('delete_file');

Route::get('/{page}', [\App\Http\Controllers\AdminController::class, 'index']);
