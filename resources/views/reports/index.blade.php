@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Report</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Progetto</th>
                <th scope="col">Tot Ore</th>
            </tr>
        </thead>
        <tbody>
            @foreach($works as $p)
            <tr>
                <td>{{ $p->name }}</td>
                <td>{{ $p->ore }}</td>            
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection