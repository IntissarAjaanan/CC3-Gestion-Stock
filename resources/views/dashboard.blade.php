@extends('layout.app')
@section('content')
    <div class="header-actions d-flex justify-between align-center">
        <h4>Welcome {{$user->name}}</h4>
        <a href="{{route('email.form')}}" class="btn btn-success">Send Email</a>
    </div>
    <div class="m-auto d-flex flex-column align-center">
        <h1 class="fs-1 text-dark">@lang('Welcome')</h1>
        <h4 class="text-gray fs-small">@lang('Slogon')</h4>
        <div class="container d-flex justify-center gap-1 flex-wrap">
            <a href="{{route('customers')}}" class="btn btn-danger">@lang('List of Customers')</a>
            <a href="{{route('suppliers')}}" class="btn btn-primary">@lang('List of Suppliers')</a>
            <a href="{{route('products')}}" class="btn btn-success">@lang('List of Products')</a>
            <a href="{{route('product.by.category')}}" class="btn btn-warning">Products by Category</a>
            <a href="/products-by-supplier"  class="btn btn-danger">Products by Supplier</a>
            <a href="/products-by-store"  class="btn btn-primary">Products by Store</a>
            <a href="{{route('product.by.order')}}" class="btn btn-secondary">Orders by Customer 0</a>
            <a href="{{route('orders')}}" class="btn btn-secondary">Orders by Customer 1</a>
            <a href="{{route('orders.view')}}" class="btn btn-secondary">Orders by Customer 2</a>
        </div>
    </div>

    <br><br>
    <div class="d-flex justify-content-center gap-3">
        <a href="{{ route('ordered.products') }}" class="btn btn-info mb-3">View Ordered Products (Eloquent join
            example)</a>
        <a href="{{ route('same.products.customers') }}" class="btn btn-warning mb-3">Customers Who Ordered the Same
            Products as Annabel Stehr</a>
        <a href="{{ route('products.orders_count') }}" class="btn btn-dark mb-3">Show Number of Orders per Product</a>
        <a href="{{ route('products.more_than_6_orders') }}" class="btn btn-primary mb-3">Products with More Than 6
            Orders</a>
        <a href="{{ route('orders.totals') }}" class="btn btn-danger mb-3">Show Total Amount per Order</a>
        <a href="{{ route('orders.greater_than_60') }}" class="btn btn-secondary mb-3">Orders with Total Greater Than
            Order 60</a>

    </div>

    <br><br>
    <div class="d-flex justify-content-center gap-3">
        <a href="{{ route('customers.orders') }}" class="btn btn-info mb-3"> 1 - clients par commande</a>
        <a href="{{ route('suppliers.products') }}" class="btn btn-warning mb-3">liste des founisseurs qui ont livré les produits commandé par ‘Annabel Stehr’</a>
        <a href="{{ route('products.same_stores') }}" class="btn btn-dark mb-3">liste des produits stockées dans les memes depots que les produits fournis par ‘Scottie Crona’</a>
        <a href="{{ route('products.countbystore') }}" class="btn btn-primary mb-3">nombre des produits par depot</a>
        <a href="{{ route('store.value') }}" class="btn btn-danger mb-3">valeur de chaque depot</a>
        <a href="{{ route('sotre.greater_than_lind') }}" class="btn btn-secondary mb-3">depots qui ont une valeur surpérieur a la valeur du depot ‘Lind-Gislason’</a>

    </div>

    
    <br><br><br>
    <div class="container mt-4">
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <h4 class="mb-0">Session</h4>
        </div>
        <div class="card-body">
            <h5 class="mb-3">
                Hello from session:
                @if(Session::has("SessionName"))
                    <span class="text-success">{{ Session("SessionName") }}</span>
                @else
                    <span class="text-muted">No session value</span>
                @endif
            </h5>

            <form method="POST" action="{{ url('saveSession') }}">
                @csrf
                <div class="mb-3">
                    <label for="txtSession" class="form-label">Type your name</label>
                    <input type="text" id="txtSession" name="txtSession" class="form-control" placeholder="Your name..." required>
                </div>
                <button type="submit" class="btn btn-secondary">Save Session</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Cookies</h4>
        </div>
        <div class="card-body">
            <h5 class="mb-3">
                Hello from cookies:
                @if(Cookie::has("UserName"))
                    <span class="text-success">{{ Cookie::get("UserName") }}</span>
                @else
                    <span class="text-muted">No cookie value</span>
                @endif
            </h5>

            <form method="POST" action="{{ url('saveCookie') }}">
                @csrf
                <div class="mb-3">
                    <label for="txtCookie" class="form-label">Type your name</label>
                    <input type="text" id="txtCookie" name="txtCookie" class="form-control" placeholder="Your name..." required>
                </div>
                <button type="submit" class="btn btn-primary">Save Cookie</button>
            </form>
        </div>
    </div>
</div>
@endsection