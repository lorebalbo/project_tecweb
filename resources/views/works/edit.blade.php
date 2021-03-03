@extends('layouts.app')

@section('content')

<div class="container">
    <div class="pb-2 mt-4 mb-2 border-bottom">
        <h1>Modifica Scheda Ore</h1> 
    </div>
    <p></p>

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
    
    <form action="{{ URL::action('WorkController@update', $work) }}" method="POST">
        <input type="hidden" name="_method" value="PATCH">
        {{ csrf_field() }}

        <div class="form-group" style="display: none;">
            <label for="user_id">Utente</label>
            <input type="text" class="form-control" name="user_id" value="{{ $work->user_id }}" readonly>
            <small class="form-text text-muted">Il mio id</small>
        </div>
        
        <div class="form-group" style="display: none;">
            <label for="project_id">Progetto</label>
            <input type="text" class="form-control" name="project_id" value="{{ $work->project_id }}" readonly>
            <small class="form-text text-muted">L'id del projetto</small>
        </div>

        <div class="form-group">
            <label for="name">Progetto</label>
            <input type="text" class="form-control" name="name" value="{{ $project[0]->name }}" readonly>
            <small class="form-text text-muted">Nome del projetto</small>
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>
            <input type="text" class="form-control" name="description" value="{{ $work->description }}">
            <small class="form-text text-muted">Modifica la descrizione</small>
        </div>

        <div class="form-group">
            <label for="date">Data</label>
            <input type="date" class="form-control" name="date" value="{{ $work->date }}" readonly>
            <small class="form-text text-muted">Modifica la data</small>
        </div>

        <div class="form-group">
            <label for="hour">Ore</label>
            <input type="number" class="form-control" name="hour" value="{{ $work->hour }}">
            <small class="form-text text-muted">Modifica il numero di ore</small>
        </div>

        <button type="submit" class="btn btn-light">Aggiorna</button>
        
        <a href="{{ URL::action('WorkController@destroy', $work) }}" class="btn btn-danger">Cancella</a>

        <a href="{{ URL::action('WorkController@index') }}" class="btn btn-secondary">Indietro</a>
    </form>
    
</div>


@endsection