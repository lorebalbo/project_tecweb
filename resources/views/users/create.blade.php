@extends('layouts.app')

@section('content')

<div class="container">
    
    <div class="pb-2 mt-4 mb-2 border-bottom">
        <h1>Inserisci un nuovo utente</h1> 
    </div>

    <div class="mt-5"></div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ URL::action('UserController@store') }}" method="POST">
        {{ csrf_field() }}

        <!-- Se il checkbox è spuntato allore viene inviato il valore 1, altrimenti viene inviato 0-->
        <div class="form-group form-check">
            <input type="hidden" class="form-check-input" name="is_admin" value="0">
            <input type="checkbox" class="form-check-input" name="is_admin" value="1">
            <label class="form-check-label" for="is_admin">Amministratore</label>
        </div>

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" name="name">
            <small class="form-text text-muted">Inserisci il nome dell'utente</small>
        </div>

        <div class="form-group">
            <label for="surname">Cognome</label>
            <input type="text" class="form-control" name="surname">
            <small class="form-text text-muted">Inserisci il cognome dell'utente</small>
        </div>

        <div class="form-group" style="display: none;">
            <label for="color">Colore</label>
            <input type="color" class="form-control" name="color" value="#3498DB">
            <small class="form-text text-muted">Assegna un colore all'utente</small>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email">
            <small class="form-text text-muted">Inserisci la mail dell'utente</small>
        </div>
        
        <div class="form-group">
            <label for="verified_email">Verifica email</label>
            <input type="text" class="form-control" name="verified_email">
            <small class="form-text text-muted">Verifica la mail dell'utente</small>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" name="password">
            <small class="form-text text-muted">Inserisci password temporanea</small>
        </div>

        <button type="submit" class="btn btn-dark">Salva</button>
        <a href="{{ URL::action('UserController@index') }}" class="btn btn-secondary">Indietro</a>
    </form>
</div>


@endsection