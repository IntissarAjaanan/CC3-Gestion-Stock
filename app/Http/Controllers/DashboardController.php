<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function customers() {
        $customers =  Customer::paginate(20);
        return view('customers.index', compact('customers'));
    }

    public function suppliers(){
        $suppliers = Supplier::all();
        return view('suppliers.index',compact('suppliers'));
    }

    public function products(){
        $products = Product::with(['category', 'supplier', 'stock'])
                    ->get();
        
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.index',compact('products', 'categories', 'suppliers'));
    }


}
