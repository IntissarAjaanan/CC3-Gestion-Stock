<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{

    public function addForm(){
        return view('customers.add');
    }

    public function add(CustomerRequest $request){
        Customer::create($request->validated());
        return redirect()
            ->route('customers')
            ->with('success', 'Customer saved successfully');
    }

    public function updateForm($id){
        $customer = Customer::find($id);
        return view('customers.update', compact('customer'));
    }

    public function update(CustomerRequest $request, $id){
        $customer = Customer::find($id);
        $customer->update($request->validated());
        return redirect()
            ->route('customers')
            ->with('success', 'Customer updated successfully');
    }

    public function deleteForm($id){
        $customer = Customer::find($id);
        return view('customers.delete', compact('customer'));
    }
    public function delete($id){
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()
            ->route('customers')
            ->with('success', 'Customer deleted successfully');
    }

    public function search($term){
        $customers = Customer::where('first_name', 'LIKE', "%$term%")
            ->orWhere('last_name', 'LIKE', "%$term%")
            ->orWhere('email', 'LIKE', "%$term%")
            ->get();
        return response()->json($customers);
    }

    public function search1($term){
        $customers = Customer::where('first_name', 'LIKE', "%$term%")
            ->orWhere('last_name', 'LIKE', "%$term%")
            ->orWhere('email', 'LIKE', "%$term%")
            ->get();
        return view('orders.customersListView', compact('customers'));
    }

    public function orderLike($customerName){
        $customer = Customer::where(DB::raw("CONCAT(customers.first_name, ' ', customers.last_name)"), '=', $customerName)->first();

        if(!$customer){
            return view('products.orderLike',compact(collect()));
        }

        $productsIds= DB::table('product_orders')
        ->join('orders','product_orders.order_id','=', 'orders.id')
        ->where('orders.customer_id', '=', $customer->id)
        ->pluck('product_orders.product_id');

        $customers = DB::table('product_orders')
        ->join('orders','product_orders.order_id','=', 'orders.id')
        ->join('products','product_orders.product_id','=', 'products.id')
        ->join('customers', 'orders.customer_id', '=', 'customers.id')
        ->where('customers.id', '!=', $customer->id)
        ->select(DB::raw("CONCAT(customers.first_name, ' ', customers.last_name) as customer_name"),
            'customers.email as customer_email',
            'products.name as product_name',
            'orders.order_date as order_date'
        )
        ->whereIn('products.id', $productsIds)
        ->get();

        return view ('customers.orderLike',compact('customers'));
    }

}
