<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $customers = Customer::all();
        $orders = collect();
        return view('orders.byCustomer',compact('customers', 'orders'));
    }

    public function getOrdersByCustomer($customerId){
        $orders = Order::with(['customer', 'product'])
                    ->where('customer_id', $customerId)
                    ->get();

        return response()->json($orders);
    }

   /////// 

    public function index1(){
        return view('orders.bySearchCustomer');
    }

    public function getOrdersByCustomer1($customerId){
        $orders = Order::where('customer_id', $customerId)
                    ->get();
        return response()->json($orders);
    }

    public function getOrderDetails1($orderId){
        $order = Order::with(['customer', 'product'])
                    ->where('id', $orderId)
                    ->first();

        return response()->json($order);
    }

    public function index2(){
        return view('orders.bySearchCustomerView');
    }

    public function getOrdersByCustomer2($customerId){
        $orders = Order::where('customer_id', $customerId)
                    ->get();
    return view('orders.ordersListView', compact('orders'));  
    }

    public function getOrderDetails2($orderId){
        $order = Order::with(['customer', 'product'])
                    ->where('id', $orderId)
                    ->first();

        return view('orders.orderDetailsView', compact('order'));
    }

}
