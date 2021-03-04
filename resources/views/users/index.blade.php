@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="pb-2 mt-4 mb-2 border-bottom">
        <h1>Anagrafica Utenti</h1> 
    </div>

    <div class="mt-5"></div>

    <a href="{{ URL::action('UserController@create') }}" class="btn btn-outline-dark float-md-right mb-2">Aggiungi</a>

    <table class="table table-striped">
        <thead>
            <tr>
                
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
                <th scope="row">@if($p->is_admin == 1) <div id="circle" style="background-color:{{ $p->color }}"></div>@endif</th>
                <td>{{ $p->name }}</td>
                <td>{{ $p->surname }}</td>
                <td>{{ $p->email }}</td>
                <td><a href="{{ URL::action('UserController@edit', $p) }}" class="btn btn-outline-dark btn-sm">Modifica</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
@endsection