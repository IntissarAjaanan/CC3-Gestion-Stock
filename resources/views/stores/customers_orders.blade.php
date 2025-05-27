@extends('layout.app')

@section('content')
<div class="container">
    <h2> 1 – afficher le nom complet du client pour chaque commande.</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order id</th>
                <th>Order date</th>
                <th>Customer name</th>

            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->customer_name }}</td>

                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucun enregistrement trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Retour au Dashboard</a>
</div>
@endsection
