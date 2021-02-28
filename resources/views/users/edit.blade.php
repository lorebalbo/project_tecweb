@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Modifica un utente</h1>

    <form action="{{ URL::action('UserController@update', $user) }}" method="POST">
        <input type="hidden" name="_method" value="PATCH">
        {{ csrf_field() }}

        <!-- il php imposta il checkbox su checked se l'utente è admin -->
        <div class="form-group form-check">
            <input type="hidden" class="form-check-input" name="is_admin" value="0">
            <input type="checkbox" class="form-check-input" name="is_admin" value="1" <?php echo ($user['is_admin']==1 ? 'checked' : '');?>>
            <label class="form-check-label" for="is_admin">Amministratore</label>
        </div>

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
            <small class="form-text text-muted">Inserisci il nome dell'utente</small>
        </div>

        <div class="form-group">
            <label for="surname">Cognome</label>
            <input type="text" class="form-control" name="surname" value="{{ $user->surname }}">
            <small class="form-text text-muted">Inserisci il cognome dell'utente</small>
        </div>

        <div class="form-group">
            <label for="color">Colore</label>
            <input type="color" class="form-control" name="color" value="{{ $user->color }}">
            <small class="form-text text-muted">Assegna un colore all'utente</small>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" value="{{ $user->email }}">
            <small class="form-text text-muted">Inserisci la mail dell'utente</small>
        </div>

        <button type="submit" class="btn btn-primary">Aggiorna</button>
        
        <a href="{{ URL::action('UserController@destroy', $user) }}" class="btn btn-danger">Cancella</a>

        <a href="{{ URL::action('UserController@index') }}" class="btn btn-secondary">Indietro</a>
    </form>
</div>


@endsection