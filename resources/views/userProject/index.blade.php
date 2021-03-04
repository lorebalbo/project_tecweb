@extends('layouts.app')

@section('content')
<div class="container">

    <div class="pb-2 mt-4 mb-2 border-bottom">
        <h1>Utenti associati al progetto: {{ $project->name }}</h1>
    </div>

    <div class="mt-5"></div>
    
    <a href="{{ URL::action('ProjectController@index') }}" class="btn btn-secondary float-md-right mb-2">Indietro</a>
    <a href="{{ URL::action('UserProjectController@create', $project) }}" class="btn btn-outline-dark float-md-right mb-2 mr-1">Aggiungi</a>
    
    <table class="table">
        <thead>
            <tr>
                
                <th scope="col">Nome</th>
                <th scope="col">Cognome</th>
                <th scope="col">Email</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
            <tr>
                
                
                <td>{{ $u->name }}</td>
                <td>{{ $u->surname }}</td>
                <td>{{ $u->email }}</td>
                <td><a href="{{ URL::action('UserProjectController@destroy', [$u, $project->id]) }}" class="btn btn-danger">Cancella Associazione</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>


@endsection