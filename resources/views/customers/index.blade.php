@extends('layout.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>List of Customers</h3>
    <div>
        <a href="{{ route('customers.addForm') }}" class="btn btn-success">Add Customer</a>
        <a href="/dashboard" class="btn btn-light">Back</a>
    </div>
</div>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="form-group" id="search-form">
    <label for="search">Search</label>
    <input type="text" class="form-control" id="search" name="search" placeholder="Search by name or email">
</div>
<div class="card">
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="tbody">
          @foreach ($customers as $customer)
              <tr>
                <td>{{$customer->first_name}} {{$customer->last_name}}</td>
                <td>{{$customer->address}}</td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->phone}}</td>
                <td>
                    <a href="{{route('customers.updateForm', $customer->id)}}" class="btn btn-primary">Edit</a>
                    <a href="{{route('customers.deleteForm', $customer->id)}}" class="btn btn-danger">Delete</a>
                </td>
              </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection

@push('script')
<script>
  $(document).ready(function(){
  const updateBaseUrl = "{{ url('customer/updateForm') }}/";
  const deleteBaseUrl = "{{ url('customer/deleteForm') }}/";

  const originalTableBody = $('#tbody').html();

  $('#search').on('keyup', function(e) {
    var val = $(this).val().trim();

    if(val.length > 0){
      var searchUrl = "/customer/search/" + encodeURIComponent(val);
      $.ajax({
        url: searchUrl,
        type: "GET",  
        success: function(data) {
          $('#tbody').empty(); 
          if (data.length === 0) {
            $('#tbody').append('<tr><td colspan="5" class="text-center">No customers found</td></tr>');
          } else {
            $.each(data, function(index, customer) {
              $('#tbody').append('<tr>' +
                '<td>' + customer.first_name + ' ' + customer.last_name + '</td>' +
                '<td>' + customer.address + '</td>' +
                '<td>' + customer.email + '</td>' +
                '<td>' + customer.phone + '</td>' +
                '<td>' +
                  '<a href="' + updateBaseUrl + customer.id + '" class="btn btn-primary">Edit</a> ' +
                  '<a href="' + deleteBaseUrl + customer.id + '" class="btn btn-danger">Delete</a>' +
                '</td>' +
                '</tr>');
            });
          }
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    } else {
      $('#tbody').html(originalTableBody);
    }
  });
});
</script>
@endpush