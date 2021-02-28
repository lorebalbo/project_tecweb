@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Scheda Ore</h1>

    <a href="{{ URL::action('WorkController@create') }}" class="btn btn-primary float-md-right mb-2">Aggiungi</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Progetto</th>
                <th scope="col">Descrizione</th>
                <th scope="col">Ora</th>
                <th scope="col">Data</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($works as $p)
            <tr>
                <td>{{ $p->name }}</td>
                <td>{{ $p->description }}</td>
                <td>{{ $p->hour }}</td>
                <td>{{ $p->date }}</td>                
                <td><a href="" class="btn btn-outline-primary btn-sm">Modifica</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection