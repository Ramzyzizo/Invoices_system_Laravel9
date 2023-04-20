<?php

use App\Http\Controllers\Customers_Report;
use App\Http\Controllers\invoices_Report;
use App\Http\Controllers\InvoicesArchiveController;
use App\Http\Controllers\InvoicesAttachmentsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::resource('/invoices',InvoicesController::class);
Route::resource('/sections',SectionsController::class);
Route::resource('/products',ProductsController::class);
Route::resource('/archive',InvoicesArchiveController::class);
// to control new attachments which added early
Route::resource('InvoiceAttachments',InvoicesAttachmentsController::class);

//----------------- Roles permission
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

// export invoices in excel
Route::get('/export_invoices',[InvoicesController::class,'export_excel']);

//to return products list according section id at {add invoice page}
Route::get('/section/{id}',[InvoicesController::class,'getproducts']);
//change status for invoice
Route::get('/update_status/{id}',[InvoicesController::class,'status_update'])->name('invoices.status');


//change status for archived_invoice
Route::get('/paid_invoices',[InvoicesController::class,'paid_invoices']);
Route::get('/unpaid_invoices',[InvoicesController::class,'unpaid_invoices']);
Route::get('/partialpaid_invoices',[InvoicesController::class,'partialpaid_invoices']);
Route::get('/archived_invoice',[InvoicesController::class,'archived']);
Route::get('/Print_invoice/{id}',[InvoicesController::class,'print_invoice']);

//to return details of invoices by id from  {add invoice page}
Route::get('/InvoicesDetails/{id}',[InvoicesDetailsController::class,'edit']);
Route::get('delete_file',[InvoicesDetailsController::class,'destroy'])->name('delete_file'); #delete attachments

//to return show attachments at  {details_invoice page}
Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'view_attachments']);
Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'download_attachments']);

// report on invoices
Route::get('invoices_report',[invoices_Report::class,'index']);
Route::post('Search_invoices',[invoices_Report::class,'Search_invoices'])->name('Search_invoices');

// report on customers
Route::get('customers_report',[Customers_Report::class,'index']);
Route::post('Search_customer',[Customers_Report::class,'Search_customers'])->name('Search_customers');

Route::get('markasread/{id}',[InvoicesController::class,'MarkAsRead'])->name('MarkAsRead');
Route::get('markasreadall',[InvoicesController::class,'MarkAsReadall'])->name('MarkAsReadall');

Route::get('/{page}',[AdminController::class,'index']);






