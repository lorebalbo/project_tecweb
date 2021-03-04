@extends('layouts.app')

@section('content')

<div class="container">
    
    <div class="pb-2 mt-4 mb-2 border-bottom">
        <h1>Inserisci un nuovo progetto</h1>
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

    <form action="{{ URL::action('ProjectController@store') }}" method="POST">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">Nome Progetto</label>
            <input type="text" class="form-control" name="name">
            <small class="form-text text-muted">Inserisci il nome del progetto</small>
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>
            <input type="text" class="form-control" name="description">
            <small class="form-text text-muted">Inserisci una breve descrizione del progetto</small>
        </div>

        <div class="form-group">
            <label for="start_date">Data inizio</label>
            <input type="date" class="form-control" name="start_date" placeholder="dd-mm-yyyy">
            <small class="form-text text-muted">Inserisci la data di inizio del progetto</small>
        </div>

        <div class="form-group">
            <label for="expected_end_date">Data fine prevista</label>
            <input type="date" class="form-control" name="expected_end_date">
            <small class="form-text text-muted">Inserisci la data di fine prevista</small>
        </div>

        <div class="form-group">
            <label for="cost_pr_hour">Costo orario</label>
            <input type="number" class="form-control" name="cost_pr_hour">
            <small class="form-text text-muted">Inserisci il costo orario del progetto</small>
        </div>

        <div class="form-group">
            <label for="note">Note</label>
            <input type="text" class="form-control" name="note">
            <small class="form-text text-muted">Inserisci qui le eventuali note</small>
        </div>

        <div class="form-group">
            <label for="client_id">Seleziona un cliente</label>
            <select class="custom-select" name="client_id">
            @foreach($clients as $client)
                <option value="{{ $client->id }}"> {{ $client->business_name }} </option>
            @endforeach 
            </select>
        </div>        

        <button type="submit" class="btn btn-dark">Salva</button>
        <a href="{{ URL::action('ProjectController@index') }}" class="btn btn-secondary">Indietro</a>
    </form>
</div>


@endsection