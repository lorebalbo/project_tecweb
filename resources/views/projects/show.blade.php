@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="pb-2 mt-4 mb-2 border-bottom">
        <h1>Dettagli progetto: {{ $project->name }}</h1> 
    </div>

    <div class="mt-5"></div>
    
    <a href="{{ URL::action('ProjectController@index') }}" class="btn btn-secondary float-md-right mb-2">Indietro</a>
    
    <table class="table">
        <thead>
            <tr>
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
                <td>{{ $project->description }}</td>
                <td>{{ date('d/m/Y', strtotime($project['start_date'])) }}</td>
                <td>{{ date('d/m/Y', strtotime($project['expected_end_date'])) }}</td>
                @if( $project->effective_end_date == NULL)
                <td>Non definita</td>    
                @else
                <td>{{ date('d/m/Y', strtotime($project['effective_end_date'])) }}</td>
                    
                @endif
                <td>{{ $project->cost_pr_hour }} €</td>
                <td>{{ $project->note }}</td>
                <td>{{ $project->client->business_name }}</td>
            </tr>
     
        </tbody>
    </table>

</div>
@endsection