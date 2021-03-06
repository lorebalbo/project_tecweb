@extends('layouts.app')

@section('content')

<div class="container">

    <div class="pb-2 mt-4 mb-2 border-bottom">
        <h1>Associa un nuovo utente al progetto: {{ $project->name }}</h1>
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

    <form action="{{ URL::action('UserProjectController@store') }}" method="POST">
        {{ csrf_field() }}       
        
            <div class="form-group">
                <label for="project_id">ID Progetto</label>
                <input type="text" class="form-control" name="project_id" value="{{ $project->id }}" readonly>
                <small class="form-text text-muted"></small>
            </div>

            <div class="form-group">
                <label for="project_name">Nome Progetto</label>
                <input type="text" class="form-control" name="project_name" value="{{ $project->name }}" readonly>
                <small class="form-text text-muted"></small>
            </div>
        

        <div class="form-group">
            <label for="user_id">Seleziona un utente</label>
            <select class="form-control" name="user_id">
            @foreach($users as $user)
                <option value="{{ $user->id }}"> {{ $user->surname }} {{ $user->name }} </option>
            @endforeach 
            </select>
        </div>        

        <button type="submit" class="btn btn-dark">Salva</button>
        <a href="{{ URL::action('UserProjectController@index', $project) }}" class="btn btn-secondary">Indietro</a>
    </form>
</div>


@endsection