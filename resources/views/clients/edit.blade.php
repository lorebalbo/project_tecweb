@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Modifica un cliente</h1>

    <form action="{{ URL::action('ClientController@update', $client) }}" method="POST">
        <input type="hidden" name="_method" value="PATCH">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="contact_name">Nome Referente</label>
            <input type="text" class="form-control" name="contact_name" value="{{ $client->contact_name }}">
            <small class="form-text text-muted">Modifica il nome del progetto</small>
        </div>

        <div class="form-group">
            <label for="contact_surname">Cognome Referente</label>
            <input type="text" class="form-control" name="contact_surname" value="{{ $client->contact_surname }}">
            <small class="form-text text-muted">Modifica una breve descrizione del progetto</small>
        </div>

        <div class="form-group">
            <label for="contact_email">Email Referente</label>
            <input type="text" class="form-control" name="contact_email" value="{{ $client->contact_email }}">
            <small class="form-text text-muted">Modifica la data di inizio del progetto</small>
        </div>

        <div class="form-group">
            <label for="business_name">Ragione Sociale</label>
            <input type="text" class="form-control" name="business_name" value="{{ $client->business_name }}">
            <small class="form-text text-muted">Modifica la data di fine prevista</small>
        </div>

        <button type="submit" class="btn btn-primary">Aggiorna</button>
        
        <a href="{{ URL::action('ClientController@destroy', $client) }}" class="btn btn-danger">Cancella</a>

        <a href="{{ URL::action('ClientController@index') }}" class="btn btn-secondary">Indietro</a>
    </form>
</div>


@endsection