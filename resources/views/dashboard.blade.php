@extends('layout.app')
@section('content')
    <div class="m-auto d-flex flex-column align-center">
        <h1 class="fs-1 text-dark">@lang('Welcome')</h1>
        <h4 class="text-gray fs-small">@lang('Slogon')</h4>
        <div class="container d-flex justify-center gap-1 flex-wrap">
            <a href="{{route('customers')}}" class="btn btn-danger">@lang('List of Customers')</a>
            <a href="{{route('suppliers')}}" class="btn btn-primary">@lang('List of Suppliers')</a>
            <a href="{{route('products')}}" class="btn btn-success">@lang('List of Products') !</a>
            <a href="{{route('product.by.category')}}" class="btn btn-warning">Products by Category !</a>
            <a class="btn btn-primary">Products by Supplier !</a>
            <a class="btn btn-danger">Products by Store !</a>
            <a href="{{route('product.by.order')}}" class="btn btn-secondary">Orders by Customer</a>
            <a href="{{route('orders')}}" class="btn btn-secondary">Orders by Customer 1</a>
            <a href="{{route('orders.view')}}" class="btn btn-secondary">Orders by Customer 2</a>
        </div>

        <br><br><br>
        <div class="container d-flex justify-center gap-1 flex-wrap">
            <a href="{{route('ordered.products')}}" class="btn btn-danger">View Ordered Products</a>
            <a href="orderLike/Rollin Cartwright" class="btn btn-success">Customers Orders Like Rollin Cartwright</a>
            <a href="{{route('orders.product')}}">Show Number of Orders per product</a>
        </div>
    </div>
@endsection