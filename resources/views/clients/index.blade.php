@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tutti i clienti</h1>

    <a href="{{ URL::action('ClientController@create') }}" class="btn btn-primary float-md-right mb-2">Aggiungi</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome Referente</th>
                <th scope="col">Cognome referente</th>
                <th scope="col">Email Referente</th>
                <th scope="col">Regione Sociale</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $c)
            <tr>
                <th>{{ $c->id }}</th>
                <td>{{ $c->contact_name }}</td>
                <td>{{ $c->contact_surname }}</td>
                <td>{{ $c->contact_email }}</td>
                <td>{{ $c->business_name }}</td>
                <td><a href="{{ URL::action('ClientController@edit', $c) }}" class="btn btn-outline-primary btn-sm">Modifica</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



@endsection