@extends('layout.app')

@section('content')
<div class="container">
    <h2>4 – le nombre des produits par depot.</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Store Id</th>
                <th>Store name</th>
                <th>Count of products</th>

            </tr>
        </thead>
        <tbody>
            @forelse($stores as $store)
                <tr>
                    <td>{{ $store->store_id }}</td>
                    <td>{{ $store->store_name }}</td>
                    <td>{{ $store->nbProducts }}</td>

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
