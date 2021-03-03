@extends('layouts.app')

@section('content')
<div class="container">

    <div class="pb-2 mt-4 mb-2 border-bottom">
        <h1>Report</h1>      
    </div>

    <p>Seleziona due date per vedere il totale delle ore spese per ogni cliente in un determinato periodo</p>

    <div class="mt-5"></div>   

    <form action="{{ URL::action('AdminReportController@search_client_hours') }}" method="POST">
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
        <button type="submit" class="btn btn-light">Cerca</button> 
        
    </form>

    <div class="mt-5"></div>  

    <p>Ecco il totale delle ore spese per ogni cliente questo mese</p>  

    <div class="mt-5"></div>     

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Cliente</th>
                <th scope="col">Ore Totali </th>
            </tr>
        </thead>
        <tbody>
            @foreach($client_hours as $p)
            <tr>
                <td>{{ $p->business_name }}</td>
                <td>{{ $p->ore }}</td>            
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection