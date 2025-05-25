@extends('layout.app')
@section('content')
<div class="d-flex justify-between mb-3">
    <h3>List of Products</h3>
    <button 
    data-bs-target="#createProductModal" 
    data-bs-toggle="modal" 
    class="btn btn-success">Add Product</button>
    <a href="{{route('dashboard')}}" class="btn btn-light">To Dashboard</a>
</div>
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="d-flex mb-3">
  <input type="text" class="form-control" placeholder="Search for products..." aria-label="Search">
  <button class="btn" type="submit">Search</button>
      <a class="btn btn-warning float-end" href="{{ route('products.export') }}"><i class="fa fa-download"></i> Export Products Data</a>
 <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#importProductModal">
                    <i class="fa fa-file"></i> Import
                </button>
</div>
<div class="card">
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Category</th>
            <th scope="col">Supplier</th>
            <th scope="col">Stock</th>
            <th scope="col">Price</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
              <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->category->name}}</td>
                <td>{{$product->supplier->first_name}} {{$product->supplier->last_name}}</td>
                <td>{{ $product->stock?->quantity ?? 'N/A' }}</td>
                <td>{{$product->price}}</td>
                <td>
                  <button data-bs-target="#editProductModal" data-id="{{$product->id}}" data-bs-toggle="modal" class="btn btn-primary">Edit</button>
                  <button data-bs-target="#deleteProductModal" data-id="{{$product->id}}" data-bs-toggle="modal" class="btn btn-danger">Delete</button>
                </td>
              </tr>
          @endforeach
        </tbody>
      </table>
</div>
@include('products.modals.import-modal')
@include('products.modals.delete-modal')
@include('products.modals.edit-modal')
@include('products.modals.add-modal')


@endsection
