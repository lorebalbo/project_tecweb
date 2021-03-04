@extends('layouts.app')

@section('content')
<div class="container">

    <div class="pb-2 mt-4 mb-2 border-bottom">
        <h1>Scheda Ore</h1> 
    </div>

    <p class="lead">Seleziona due date per vedere le attività svolte nel preiodo</p>

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

    <form action="{{ URL::action('WorkController@search') }}" method="POST">
        {{ csrf_field() }}

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="from_date">Da</label>
                <input type="date" class="form-control" name="from_date">
                <small class="form-text text-muted">Inserisci la data iniziale</small>
            </div>
            <div class="form-group col-md-6">
                <label for="to_date">a</label>
                <input type="date" class="form-control" name="to_date">
                <small class="form-text text-muted">Inserisci la data finale</small>
            </div>
        </div>    
        <button type="submit" class="btn btn-outline-dark">Cerca</button> 
        
    </form>

    <div class="mt-5"></div>   

    <div class="pb-2 mt-4 mb-2 border-bottom"></div>
    <p class="lead">Attività svolte nel mese corrente</p>
    
    <div class="mt-5"></div> 
      

    <a href="{{ URL::action('WorkController@create') }}" class="btn btn-outline-dark float-md-right mb-2" >Aggiungi</a>
    <table id="order_data" class="table">
        <thead >
            <tr>
                <th scope="col">Progetto</th>
                <th scope="col">Descrizione attività</th>
                <th scope="col">Ore spese</th>
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