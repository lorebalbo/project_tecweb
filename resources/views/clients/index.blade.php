@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="pb-2 mt-4 mb-2 border-bottom">
        <h1>Anagrafica Clienti</h1> 
    </div>

    <div class="mt-5"></div>

    <a href="{{ URL::action('ClientController@create') }}" class="btn btn-outline-dark float-md-right mb-2">Aggiungi</a>

    <table class="table">
        <thead>
            <tr>
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
                <td>{{ $c->contact_name }}</td>
                <td>{{ $c->contact_surname }}</td>
                <td>{{ $c->contact_email }}</td>
                <td>{{ $c->business_name }}</td>
                <td><a href="{{ URL::action('ClientController@edit', $c) }}" class="btn btn-outline-dark btn-sm">Modifica</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



@endsection