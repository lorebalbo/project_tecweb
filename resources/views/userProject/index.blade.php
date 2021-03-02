@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Utenti associati al progetto {{ $project->name }}</h1>
    <a href="{{ URL::action('ProjectController@index') }}" class="btn btn-secondary">Indietro</a>
    <a href="{{ URL::action('UserProjectController@create', $project) }}" class="btn btn-primary float-md-right mb-2">Aggiungi</a>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Admin</th>
                <th scope="col">Nome</th>
                <th scope="col">Cognome</th>
                <th scope="col">Email</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
            <tr>
                <td> <div id="circle" style="background-color:{{ $u->color }}"></div> </td>
                <th scope="row">{{ $u->is_admin }}</th>
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