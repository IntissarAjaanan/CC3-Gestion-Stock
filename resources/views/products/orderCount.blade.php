@extends('layout.app')
@section('content')
<div class="d-flex justify-between mb-3">
    <h3>Show Number of Orders per Product</h3>
    <a href="{{route('dashboard')}}" class="btn btn-light">To Dashboard</a>
</div>
<div class="card">
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Product name</th>
            <th scope="col">Number of Orders</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($ as $)
              <tr>
                <td>{{ }}</td>
                <td>{{ }}</td>
              </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection