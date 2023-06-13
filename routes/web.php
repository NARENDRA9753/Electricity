<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
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
    return view('dashboard');
});

Route::get('/customerList',[CustomerController::class,'index'])->name('customerList');
Route::get('/addCustomer',[CustomerController::class,'addCustomer'])->name('addCustomer');
Route::post('/saveCustomer',[CustomerController::class,'saveCustomer'])->name('saveCustomer');
Route::get('/editCustomer/{id}',[CustomerController::class,'editCustomer'])->name('editCustomer');
Route::post('/updateCustomer/{id}',[CustomerController::class,'updateCustomer'])->name('updateCustomer');
Route::post('/deleteCustomer',[CustomerController::class,'deleteCustomer'])->name('deleteCustomer');
Route::get('/usersBill',[CustomerController::class,'usersBill'])->name('usersBill');
Route::get('/createBill',[CustomerController::class,'createBill'])->name('createBill');
Route::post('/saveBill',[CustomerController::class,'saveBill'])->name('saveBill');


