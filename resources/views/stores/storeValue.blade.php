@extends('layout.app')

@section('content')
<div class="container">
    <h2>5 – la valeur de chaque depot. (somme des valeurs des produits qu’il contient)</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Store name</th>
                <th>Valeur total</th>
            </tr>
        </thead>
        <tbody>
              @forelse($stores as $store)
                <tr>
                    <td>{{ $store->store_name }}</td>
                    <td>{{ $store->totalV }}</td>
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
