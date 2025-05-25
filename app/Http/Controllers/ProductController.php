<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function store($request)
    {
        $validated = $request->validated();

        // Handle file upload if present
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('products', 'public');
            $validated['picture'] = $picturePath;
        }

        $product = Product::create($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'product' => $product]);
        }

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified product in storage.
     */
    public function update($request, Product $product)
    {
        $validated = $request->validated();

        // Handle file upload if present
        if ($request->hasFile('picture')) {
            // Delete old picture if exists
            if ($product->picture) {
                Storage::disk('public')->delete($product->picture);
            }

            $picturePath = $request->file('picture')->store('products', 'public');
            $validated['picture'] = $picturePath;
        }

        $product->update($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'product' => $product]);
        }

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // Delete product image if exists
        if ($product->picture) {
            Storage::disk('public')->delete($product->picture);
        }

        $product->delete();

        return response()->json(['success' => true]);
    }

    public function byCategory(){
        $categories = Category::all();
        $products = collect();
        
        return view('products.byCategory', compact('categories', 'products'));
    }

    public function byCategoryX(Category $category){
        $categories = Category::all();
        $products = $category->products()
            ->with(['supplier', 'stock'])
            ->get();
        
        return view('products.byCategory', compact('categories', 'products'));
    }

    public function orderedProducts(){
        $products = DB::table('product_orders')
            ->join('products', 'product_orders.product_id', '=', 'products.id')
            ->join('orders', 'product_orders.order_id', '=', 'orders.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('suppliers','products.supplier_id','=','suppliers.id')
            ->select(
                'products.name as product_name' , 
                DB::raw("CONCAT(customers.first_name, ' ', customers.last_name)  as customer_name"),
                'categories.name as category_name',
                DB::raw("CONCAT(suppliers.first_name, ' ', suppliers.last_name) as supplier_name"),
                'orders.order_date as order_date'
            )
            ->get();

        // dd($products);
        return View('products.orderedProducts', compact('products'));
    }

    public function ordersCount(){
        $ordersCount = DB::table('product_orders')
            ->join('products', 'product_orders.product_id', '=', 'products.id')
            ->select('products.name as product_name', DB::raw('COUNT(product_orders.product_id) as countOrder'))
            ->groupBy('product_orders.product_id', 'products.name')
            ->get();
        
        dd($ordersCount);
        return view('products.ordersCount', compact('ordersCount'));
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }

      /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request)
    {
      
        Excel::import(new ProductImport, $request->file('file'));

        return back()->with('success', 'Products imported successfully.');
    }


}
