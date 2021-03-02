@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tutti i progetti</h1>

    <a href="{{ URL::action('WorkController@create') }}" class="btn btn-primary float-md-right mb-2">Aggiungi</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Utente</th>
                <th scope="col">Progetto</th>
                <th scope="col">Descrizione</th>
                <th scope="col">Ora</th>
                <th scope="col">Data</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($works as $w)
            <tr>
                <th scope="row">{{ $w->user_id }}</th>
                <td>{{ $w->project_id }}</td>
                <td>{{ $w->description }}</td>
                <td>{{ $w->hour }}</td>
                <td>{{ date('d/m/Y', strtotime($w['date'])) }}</td>
                <td><a href="{{ URL::action('WorkController@edit', $w) }}" class="btn btn-outline-primary btn-sm">Modifica</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection