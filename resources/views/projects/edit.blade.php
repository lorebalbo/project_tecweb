@extends('layouts.app')

@section('content')

<div class="container">
    
    <div class="pb-2 mt-4 mb-2 border-bottom">
        <h1>Modifica progetto</h1>
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

    <form action="{{ URL::action('ProjectController@update', $project) }}" method="POST">
        <input type="hidden" name="_method" value="PATCH">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">Nome Progetto</label>
            <input type="text" class="form-control" name="name" value="{{ $project->name }}">
            <small class="form-text text-muted">Modifica il nome del progetto</small>
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>
            <input type="text" class="form-control" name="description" value="{{ $project->description }}">
            <small class="form-text text-muted">Modifica una breve descrizione del progetto</small>
        </div>

        <div class="form-group">
            <label for="start_date">Data inizio</label>
            <input type="date" class="form-control" name="start_date" date-date-format="DD MM YYYY" value="{{ $project->start_date }}">
            <small class="form-text text-muted">Modifica la data di inizio del progetto</small>
        </div>

        <div class="form-group">
            <label for="expected_end_date">Data fine prevista</label>
            <input type="date" class="form-control" name="expected_end_date" value="{{ $project->expected_end_date }}">
            <small class="form-text text-muted">Modifica la data di fine prevista</small>
        </div>

        <div class="form-group">
            <label for="effective_end_date">Data fine effettiva</label>
            <input type="date" class="form-control" name="effective_end_date" value="{{ $project->effective_end_date }}">
            <small class="form-text text-muted">Modifica la data di fine effettiva</small>
        </div>

        <div class="form-group">
            <label for="cost_pr_hour">Costo orario</label>
            <input type="number" class="form-control" name="cost_pr_hour" value="{{ $project->cost_pr_hour }}">
            <small class="form-text text-muted">Modifica il costo orario del progetto</small>
        </div>

        <div class="form-group">
            <label for="note">Note</label>
            <input type="text" class="form-control" name="note" value="{{ $project->note }}">
            <small class="form-text text-muted">Modifica le eventuali note</small>
        </div>

        <button type="submit" class="btn btn-dark">Aggiorna</button>
        
        <a href="{{ URL::action('ProjectController@destroy', $project) }}" class="btn btn-danger">Cancella</a>

        <a href="{{ URL::action('ProjectController@index') }}" class="btn btn-secondary">Indietro</a>
    </form>
</div>


@endsection