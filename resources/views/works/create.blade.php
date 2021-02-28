@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Inserisci giornata di lavoro</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ URL::action('WorkController@store') }}" method="POST">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="description">Descrizione</label>
            <input type="text" class="form-control" name="description">
            <small class="form-text text-muted">Inserisci una breve descrizione</small>
        </div>

        <div class="form-group">
            <label for="date">Data</label>
            <input type="date" class="form-control" name="date">
            <small class="form-text text-muted">Inserisci la data</small>
        </div>

        <div class="form-group">
            <label for="hour">Ore</label>
            <input type="number" class="form-control" name="hour">
            <small class="form-text text-muted">Inserisci quante ore hai lavorato al progetto</small>
        </div>

        <div class="form-group">
            <label for="project_id">Seleziona un progetto</label>
            <select class="form-control" name="project_id">
            @foreach($projects as $project)
                <option value="{{ $project->id }}"> {{ $project->name }} </option>
            @endforeach 
            </select>
        </div>        

        <button type="submit" class="btn btn-primary">Salva</button>
        <a href="{{ URL::action('WorkController@index') }}" class="btn btn-secondary">Indietro</a>
    </form>
</div>
@endsection