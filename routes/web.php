<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShopBranchController;

use App\Http\Controllers\ShopOwnerController;
use App\Http\Controllers\ShopBranchListController;
use App\Http\Controllers\BranchBillController;








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

// Registration
// Route::get('/',[UserController::class,'Registration'])->name('registration');
Route::get('/',[UserController::class,'Login'])->name('login');


Route::get('registration',[UserController::class,'Registration'])->name('registration');
Route::post('registration',[UserController::class,'RegistrationCreate'])->name('registration');

// Login
Route::get('login',[UserController::class,'Login'])->name('login');
Route::post('login',[UserController::class,'LoginCreate'])->name('login');
Route::get('/logout',[UserController::class,'Logout'])->name('logout');


//admin
Route::resource('shop',ShopController::class);  
Route::resource('shop-branch',ShopBranchController::class);
Route::get('view-branch-bills',[BranchBillController::class,'viewBranchBills'])->name('viewBranchBills');
Route::post('get-shop-wise-branches',[BranchBillController::class,'getShopWiseBranches'])->name('getShopWiseBranches');
Route::post('get-branch-bill',[BranchBillController::class,'getBranchBill'])->name('getBranchBill');


// Shop-Owner 
Route::resource('shop-owner',ShopOwnerController::class);  //shop-self owner list
Route::resource('shop-branches-list',ShopBranchListController::class);
Route::get('view-shop-owner-branch-bills',[ShopOwnerController::class,'viewShopOwnerBranchBills'])->name('viewShopOwnerBranchBills');


// brach owner 
Route::resource('branch-bill',BranchBillController::class);

// Route::get('view-branch-bills',[BranchBillController::class,'viewBranchBills'])->name('viewBranchBills');
// Route::post('get-shop-wise-branches',[BranchBillController::class,'getShopWiseBranches'])->name('getShopWiseBranches');
// Route::post('get-branch-bill',[BranchBillController::class,'getBranchBill'])->name('getBranchBill');
