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
  <input type="text" class="form-control me-2" id="searchInput" placeholder="Search for products..." aria-label="Search">
      <a class="btn btn-warning float-end" href="{{ route('products.export') }}"><i class="fa fa-download"></i> Export Products Data</a>
  <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#importProductModal">
                    <i class="fa fa-file"></i> Import
                </button>
                <a class="btn btn-info" href="{{ route('products.print') }}" target="_blank"><i class="fa fa-print"></i>
                    Print</a>
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
            <th scope="col">Image</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody id="productTableBody">
          @foreach ($products as $product)
              <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->category->name}}</td>
                <td>{{$product->supplier->first_name}} {{$product->supplier->last_name}}</td>
                <td>{{ $product->stock?->quantity ?? 'N/A' }}</td>
                <td>{{$product->price}}</td>
                <td>
                    @if($product->picture)
                        <img src="{{ asset('storage/' . $product->picture) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 50px; height: 50px;">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                <td>
                    <button data-bs-target="#editProductModal" data-name="{{ $product->name }}" data-id="{{$product->id}}" data-bs-toggle="modal" class="btn btn-primary edit-product">Edit</button>
                    <button data-bs-target="#deleteProductModal" data-name="{{ $product->name }}" data-id="{{$product->id}}" data-bs-toggle="modal" class="btn btn-danger delete-product">Delete</button>
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

@push('script')
<script>
    $(document).ready(function () {
        function attachEventHandlers() {
            $('.edit-product').on('click', function () {
                let productId = $(this).data('id');
                $.ajax({
                    url: `/api/products/${productId}`,
                    type: 'GET',
                    success: function (product) {
                        $('#editProductId').val(product.id);
                        $('#editName').val(product.name);
                        $('#editDescription').val(product.description);
                        $('#editPrice').val(product.price);
                        $('#editCategoryId').val(product.category_id);
                        $('#editSupplierId').val(product.supplier_id);
                        $('#editProductForm').attr('action', `/products/${productId}`);
                    },
                    error: function (xhr) {
                        console.error('Error fetching product data:', xhr);
                    }
                });
            });

            $('.delete-product').on('click', function () {
                let productId = $(this).data('id');
                let productName = $(this).data('name');

                $('#deleteProductId').val(productId);
                $('#productName').text(productName);
                $('#deleteProductForm').attr('action', `/products/${productId}`);
            });
        }

        $('#searchInput').on('keyup', function () {
            const query = $(this).val();

            axios.get("{{ route('products.search') }}", {
                params: { query: query }
            })
            .then(function (response) {
                const products = response.data;
                let rows = '';

                products.forEach(product => {
                    rows += `
                        <tr>
                            <td>${product.name}</td>
                            <td>${product.description}</td>
                            <td>${product.category?.name ?? ''}</td>
                            <td>${product.supplier?.first_name ?? ''} ${product.supplier?.last_name ?? ''}</td>
                            <td>${product.stock?.quantity ?? 'N/A'}</td>
                            <td>${product.price}</td>
                            <td>
                                <button data-bs-target="#editProductModal" data-name="${product.name}" data-id="${product.id}" data-bs-toggle="modal" class="btn btn-primary edit-product">Edit</button>
                                <button data-bs-target="#deleteProductModal" data-name="${product.name}" data-id="${product.id}" data-bs-toggle="modal" class="btn btn-danger delete-product">Delete</button>
                            </td>
                        </tr>
                    `;
                });

                $('#productTableBody').html(rows);
                attachEventHandlers();
            })
            .catch(function (error) {
                console.error('Search error:', error);
            });
        });

        attachEventHandlers();
    });
</script>
@endpush
@endsection
