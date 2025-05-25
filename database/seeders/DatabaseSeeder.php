<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    protected $categories = [
        'Electronics',
        'Clothing',
        'Home Appliances',
        'Furniture',
        'Books',
        'Sports Equipment',
        'Toys',
        'Beauty & Personal Care',
        'Office Supplies',
        'Kitchen & Dining',
        'Automotive',
        'Garden & Outdoor',
        'Health & Wellness',
        'Pet Supplies',
        'Tools & Hardware'
    ];

    public function run(): void
    {
        User::factory(10)->create();

        $suppliers = Supplier::factory(10)->create();
        $custumers = Customer::factory(10)->create();
        $stores = Store::factory(10)->create();
        
        $categories = collect($this->categories)->map(function($name){
            return Category::create(['name'=>$name]);
        });

        $products = Product::factory(20)->recycle($suppliers)->recycle($categories);
        $orders = Order::factory(15)-> recycle($custumers);
        $stocks = Stock::factory(15)->recycle($products,$orders);
        $transactionals = Transaction::factory(10)->create();
    }
}
