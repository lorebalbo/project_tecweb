@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="pb-2 mt-4 mb-2 border-bottom">
        <h1>Scheda Ore</h1> 
    </div>
    <p class="lead">Elenco delle attività svolte dal {{ date('d/m/Y', strtotime($request['from_date'])) }} al {{ date('d/m/Y', strtotime($request['to_date'])) }}</p>

    <div class="mt-5"></div>
    
    @if (!empty($msg))
        <div class="alert alert-primary">{{ $msg }}</div>
    @endif    

    <a href="{{ URL::action('WorkController@index') }}" class="btn btn-secondary float-md-right mb-2">Indietro</a>
    
    <table id="order_data" class="table">
        <thead>
            <tr>
                <th scope="col">Progetto</th>
                <th scope="col">Descrizione</th>
                <th scope="col">Ore</th>
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
                <td>{{ date('d/m/Y', strtotime($p['date'])) }}</td>          
                <td><a href="{{ URL::action('WorkController@edit', $p) }}" class="btn btn-outline-dark btn-sm">Modifica</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection