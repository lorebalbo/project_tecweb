@extends('layouts.app')

@section('content')
<div class="container">

    <div class="pb-2 mt-4 mb-2 border-bottom">
        <h1>Report</h1>      
    </div>

    <div class="mt-5"></div>  

    <p>Ecco il totale delle ore spese su ogni progetto dal {{ date('d/m/Y', strtotime($request['from_date'])) }} al {{ date('d/m/Y', strtotime($request['to_date'])) }}</p>  
    <a href="{{ URL::action('AdminReportController@client_hours') }}" class="btn btn-secondary float-md-right mb-2">Indietro</a>
    <div class="mt-5"></div>     

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Progetto</th>
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