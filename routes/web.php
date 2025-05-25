<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/customers', [DashboardController::class, 'customers'])->name('customers');
Route::get('/suppliers', [DashboardController::class, 'suppliers'])->name('suppliers');
Route::get('/products', [DashboardController::class, 'products'])->name('products');

//Products
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/api/products/{product}', [ProductController::class, 'show'])->name('api.products.show');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::post('/products/delete/{productId}', [ProductController::class, 'delete'])->name('products.delete');
Route::get('/by-category', [ProductController::class, 'byCategory'])->name('product.by.category');
Route::get('/by-category/{category}', [ProductController::class, 'byCategoryX'])->name('product.by.category.x');

//Orders
Route::get('/by-customer', [OrderController::class, 'index'])->name('product.by.order');
Route::get('/by-customer/{customer}', [OrderController::class, 'getOrdersByCustomer'])->name('product.by.order.x');

//Customers
Route::get('/customer/addForm', [CustomerController::class, 'addForm'])->name('customers.addForm');
Route::get('/customer/updateForm/{id}', [CustomerController::class, 'updateForm'])->name('customers.updateForm');
Route::get('/customer/deleteForm/{id}', [CustomerController::class, 'deleteForm'])->name('customers.deleteForm');

Route::get('/customer/search/{term}', [CustomerController::class, 'search'])->name('customers.search');
Route::get('/customer/search1/{term}', [CustomerController::class, 'search1'])->name('customers.search');

Route::post('/customer/add', [CustomerController::class, 'add'])->name('customers.add');
Route::put('/customer/update/{id}', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('/customer/delete/{id}', [CustomerController::class, 'delete'])->name('customers.delete');


//Suppliers
Route::get('/supplier/addForm', [SupplierController::class, 'addForm'])->name('suppliers.addForm');
Route::post('/supplier/add', [SupplierController::class, 'add'])->name('suppliers.add');
Route::get('/supplier/updateForm/{id}', [SupplierController::class, 'updateForm'])->name('suppliers.updateForm');
Route::post('/supplier/update/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
Route::get('/supplier/deleteForm/{id}', [SupplierController::class, 'deleteForm'])->name('suppliers.deleteForm');
Route::delete('/supplier/delete/{id}', [SupplierController::class, 'delete'])->name('suppliers.delete');

//Orders
Route::get('/orders/by-customer',[OrderController::class, 'index1'])->name('orders');
Route::get('/orders/by-customer/{customerId}', [OrderController::class, 'getOrdersByCustomer1'])->name('orders.by.customer');
Route::get('/orders/by-customer/orderDetails/{orderId}', [OrderController::class, 'getOrderDetails1'])->name('orders.details');
////by view
Route::get('/orders/by-customer-view',[OrderController::class, 'index2'])->name('orders.view');
Route::get('/orders/by-customer-view/{customerId}', [OrderController::class, 'getOrdersByCustomer2'])->name('orders.by.customer.view');
Route::get('/orders/by-customer-view/orderDetails/{orderId}', [OrderController::class, 'getOrderDetails2'])->name('orders.details.view');

//translate
Route::get('/changeLocale/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'es', 'fr', 'ar'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
});

//sql
Route::get('ordered_products', [ProductController::class, 'orderedProducts'])->name('ordered.products');
Route::get('orderLike/{customerName}', [CustomerController::class, 'orderLike'])->name('order.like');
Route::get('orders.product', [ProductController::class, 'ordersCount'])->name('orders.product');


//send Email
Route::get('email', [EmailController::class, 'index'])->name('email.form');
Route::post('email/send', [EmailController::class, 'send'])->name('email.send');

// Authentication Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Email Verification Routes
Route::get('/email/verify', [AuthController::class, 'verificationNotice'])->name('verification.notice');
Route::get('/email/verify/{token}', [AuthController::class, 'verifyEmail'])->name('verification.verify');

// Password Reset Routes
Route::get('/password/reset', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/password/email', [AuthController::class, 'forgotPassword'])->name('password.email');
Route::get('/password/reset/{token}/{email}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

// Profile Routes
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
Route::put('/password', [AuthController::class, 'updatePassword'])->name('password.change');

Route::get('products-export', [ProductController::class, 'export'])->name('products.export');
Route::post('products-import', [ProductController::class, 'import'])->name('products.import');