<?php

use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\InvoicesController;
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

Route::resource('invoices', 'InvoicesController');

Route::resource('sections', 'SectionsController');

Route::resource('products', 'ProductsController');

Route::resource('InvoiceAttachments', 'InvoiceAttachmentsController');

Route::get('/section/{id}', [InvoicesController::class, 'getproducts']);

Route::get('/edit_invoice/{id}', 'InvoicesController@edit');

Route::get('Status_show/{id}', [InvoicesController::class, 'show'])->name('Status_show');

Route::post('Status_Update/{id}', [InvoicesController::class, 'status_update'])->name('Status_Update');

Route::get('/InvoicesDetails/{id}', 'InvoicesDetailsController@edit');

Route::get('download/{invoice_number}/{file_name}', 'InvoicesDetailsController@get_file');

Route::get('View_file/{invoice_number}/{file_name}', 'InvoicesDetailsController@open_file');

Route::post('delete_file', 'InvoicesDetailsController@destroy')->name('delete_file');

Route::get('Invoice_Paid', [InvoicesController::class, 'Invoice_Paid']);

Route::get('Invoice_UnPaid', [InvoicesController::class, 'Invoice_UnPaid']);

Route::get('Invoice_Partial', [InvoicesController::class, 'Invoice_Partial']);

Route::resource('Archive', 'InvoiceArchiveController');

Route::get('Print_invoice/{id}', [InvoicesController::class, 'Print_invoice']);

Route::get('export_invoices', [InvoicesController::class, 'export']);


Route::group(['middleware' => ['auth']], function () {

    Route::resource('roles', 'RoleController');

    Route::resource('users', 'UserController');

});


Route::get('invoices_report', 'Invoices_Report@index');

Route::post('Search_invoices', 'Invoices_Report@Search_invoices');

Route::get('customers_report', 'Customers_Report@index')->name("customers_report");

Route::post('Search_customers', 'Customers_Report@Search_customers');

Route::get('MarkAsRead_all','InvoicesController@MarkAsRead_all')->name('MarkAsRead_all');

Route::get('unreadNotifications_count', 'InvoicesController@unreadNotifications_count')->name('unreadNotifications_count');

Route::get('unreadNotifications', 'InvoicesController@unreadNotifications')->name('unreadNotifications');

Route::get('/{page}', 'AdminController@index');
