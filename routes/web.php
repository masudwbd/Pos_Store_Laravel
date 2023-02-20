<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\EmployeController;
use App\Http\Controllers\Admin\AdvanceSalaryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PosController;
use App\Http\Controllers\Admin\PresentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SupplierController;
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

Route::get('/index', [IndexController::class, 'index'])->name('admin.index');


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'employe'], function () {
    Route::get('/', [EmployeController::class, 'index'])->name('employe.index');
    Route::get('/add', [EmployeController::class, 'add_employe'])->name('add_employe');
    Route::post('/store', [EmployeController::class, 'store'])->name('employe.store');
    Route::get('/edit/{id}', [EmployeController::class, 'edit']);
    Route::post('/update', [EmployeController::class, 'update'])->name('employe.update');
    Route::get('/delete/{id}', [EmployeController::class, 'delete'])->name('employe.delete');
});

Route::group(['prefix' => 'customer'], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/add', [CustomerController::class, 'add_new'])->name('customer.add');
    Route::post('/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/edit/{id}', [CustomerController::class, 'edit']);
    Route::post('/update', [CustomerController::class, 'update'])->name('customer.update');
    // Route::get('/delete/{id}', [EmployeController::class, 'delete'])->name('employe.delete');
});

Route::group(['prefix' => 'supplier'], function () {
    Route::get('/', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/add', [SupplierController::class, 'add_new'])->name('supplier.add');
    Route::post('/store', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/edit/{id}', [SupplierController::class, 'edit']);
    Route::post('/update', [SupplierController::class, 'update'])->name('supplier.update');
    Route::get('/delete/{id}', [SupplierController::class, 'delete'])->name('supplier.delete');
});

Route::group(['prefix' => 'salary'], function () {
    Route::get('/', [AdvanceSalaryController::class, 'index'])->name('salary.index');
    Route::get('/add', [AdvanceSalaryController::class, 'add_new'])->name('salary.add');
    Route::post('/store', [AdvanceSalaryController::class, 'store'])->name('salary.store');
    // Route::get('/edit/{id}', [SupplierController::class, 'edit']);
    // Route::post('/update', [SupplierController::class, 'update'])->name('supplier.update');
    // Route::get('/delete/{id}', [SupplierController::class, 'delete'])->name('supplier.delete');
});

Route::get('/get-salary/{id}', [AdvanceSalaryController::class, 'employer_salary']);

Route::group(['prefix' => 'category'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/add', [CategoryController::class, 'add_new'])->name('category.add');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('/update', [CategoryController::class, 'update'])->name('category.update');
    // Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('supplier.delete');
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/add', [ProductController::class, 'add_new'])->name('product.add');
    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/edit/{id}', [ProductController::class, 'edit']);
    Route::post('/update', [ProductController::class, 'update'])->name('product.update');
    Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('/import-products', [ProductController::class, 'import_products'])->name('product.import_products');
    Route::get('/export', [ProductController::class, 'export'])->name('product.export');
    Route::post('/import', [ProductController::class, 'import'])->name('product.import');
});

Route::group(['prefix' => 'present'], function () {
    Route::get('/add', [PresentController::class, 'add_new'])->name('present.add');
    Route::get('/', [PresentController::class, 'index'])->name('present.index');
    Route::post('/store', [PresentController::class, 'store'])->name('present.store');
    Route::get('/edit/{edit_date}', [PresentController::class, 'edit'])->name('present.edit');
    Route::post('/update', [PresentController::class, 'update'])->name('present.update');
    // Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
});


Route::group(['prefix' => 'settings'], function () { 
    Route::get('/' , [SettingsController::class ,  'index'])->name('settings.index');
    Route::post('/update' , [SettingsController::class ,  'update'])->name('settings.update');
});

Route::group(['prefix' => 'pos'], function () { 
    Route::get('/' , [PosController::class ,  'index'])->name('pos.index');
    Route::post('/add' , [PosController::class ,  'add_to_cart'])->name('product.add.to.cart');
    Route::post('/cart-update/{id}' , [PosController::class ,  'update_cart'])->name('cart.update');
    Route::post('/cart-delete/{id}' , [PosController::class ,  'delete_cart'])->name('cart.delete');
    Route::post('/create-invoice' , [PosController::class ,  'create_invoice'])->name('create.invoice');
    Route::post('/order-store' , [PosController::class ,  'order_store'])->name('order.store');
});

Route::group(['prefix' => 'orders'], function () { 
    Route::get('/' , [OrderController::class ,  'index'])->name('orders.index');
});

Route::group(['prefix' => 'dashboard'], function () { 
    Route::get('/' , [DashboardController::class ,  'index'])->name('dashboard.index');
});

Route::group(['prefix' => 'admin'], function () { 
    Route::get('/' , [AdminController::class ,  'logout'])->name('admin.logout');
});

