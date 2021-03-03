@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dettaglio progetto</h1>

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
                <th scope="col">Cliente</th>
            </tr>
        </thead>
        <tbody>
            
            <tr>
                <th> {{ $project->name }}</th>
                <td>{{ $project->description }}</td>
                <td>{{ date('d/m/Y', strtotime($project['start_date'])) }}</td>
                <td>{{ date('d/m/Y', strtotime($project['expected_end_date'])) }}</td>
                <td>{{ date('d/m/Y', strtotime($project['effective_end_date'])) }}</td>
                <td>{{ $project->cost_pr_hour }} €</td>
                <td>{{ $project->note }}</td>
                <td>{{ $project->client->business_name }}</td>
            </tr>
     
        </tbody>
    </table>

</div>
@endsection