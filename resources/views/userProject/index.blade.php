@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Utenti associati al progetto {{ $project->name }}</h1>

    <a href="{{ URL::action('UserProjectController@create', $project) }}" class="btn btn-primary float-md-right mb-2">Aggiungi</a>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Admin</th>
                <th scope="col">Nome</th>
                <th scope="col">Cognome</th>
                <th scope="col">Email</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $p)
            <tr>
                <td> <div id="circle" style="background-color:{{ $p->color }}"></div> </td>
                <th scope="row">{{ $p->is_admin }}</th>
                <td>{{ $p->name }}</td>
                <td>{{ $p->surname }}</td>
                <td>{{ $p->email }}</td>
                <td><a href="" class="btn btn-outline-primary btn-sm">Modifica</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>


@endsection