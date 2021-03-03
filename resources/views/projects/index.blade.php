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
                <th scope="col">Cliente</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $p)
            <tr>
                <th scope="row">{{ $p->name }}</th>
                <td>{{ $p->description }}</td>
                <td>{{ $p->client->business_name }}</td>
                <td><a href="{{ URL::action('ProjectController@edit', $p) }}" class="btn btn-outline-primary btn-sm">Modifica</a>
                    <a href="{{ URL::action('UserProjectController@index', $p) }}" class="btn btn-outline-primary btn-sm">Utenti associati</a>
                    <a href="{{ URL::action('ProjectController@show', $p) }}" class="btn btn-outline-primary btn-sm">dettagli</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection