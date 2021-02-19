@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tutti i progetti</h1>

    <a href="{{ URL::action('ProjectController@create') }}" class="btn btn-primary float-md-right mb-2">Aggiungi</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Descrizione</th>
                <th scope="col">Data Inizio</th>
                <th scope="col">Data Fine Prevista</th>
                <th scope="col">Data Fine Effettiva</th>
                <th scope="col">Costo Orario</th>
                <th scope="col">Note</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $p)
            <tr>
                <th scope="row">{{ $p->name }}</th>
                <td>{{ $p->description }}</td>
                <td>{{ date('d/m/Y', strtotime($p['start_date'])) }}</td>
                <td>{{ date('d/m/Y', strtotime($p['expected_end_date'])) }}</td>
                <td>{{ date('d/m/Y', strtotime($p['effective_end_date'])) }}</td>
                <td>{{ $p->cost_pr_hour }} €</td>
                <td>{{ $p->note }}</td>
                <td><a href="{{ URL::action('ProjectController@edit', $p) }}" class="btn btn-outline-primary btn-sm">Modifica</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection