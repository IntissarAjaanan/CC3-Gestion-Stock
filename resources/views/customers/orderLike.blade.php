@extends('layout.app')
@section('content')
<div class="d-flex justify-between mb-3">
    <h3>List of Customers</h3>
    <a href="/" class="btn btn-light">To Dashboard</a>
</div>
<div class="card">
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Nom Client</th>
            <th scope="col">Gmail</th>
            <th scope="col">Produit commande</th>
            <th scope="col">Date de commande</th>
          </tr>
        </thead>
        <tbody id="tbody">
          @forelse ($customers as $customer)
              <tr>
                <td>{{ $customer->customer_name }}</td>
                <td>{{ $customer->customer_email }}</td>
                <td>{{ $customer->product_name }}</td>
                <td>{{ $customer->order_date }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="4">No Customer Found</td>
              </tr>
          @endforelse
        </tbody>
      </table>
</div>
@endsection