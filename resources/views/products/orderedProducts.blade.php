@extends('layout.app')
@section('content')
<div class="d-flex justify-between mb-3">
    <h3>Ordred Products</h3>
    <a href="{{route('dashboard')}}" class="btn btn-light">To Dashboard</a>
</div>
<div class="card">
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Product name</th>
            <th scope="col">Client name</th>
            <th scope="col">Category</th>
            <th scope="col">Fournisseur</th>
            <th scope="col">Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
              <tr>
                <td>{{ $product->product_name}}</td>
                <td>{{ $product->customer_name}}</td>
                <td>{{ $product->category_name }}</td>
                <td>{{ $product->supplier_name }}</td>
                <td>{{ $product->order_date }}</td>
              </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection
