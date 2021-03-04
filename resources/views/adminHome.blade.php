@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <img src="{{ ('/homeAdmin.jpg') }}" class="card-img shadow" alt="...">
        </div>
    </div>

   

    <p class="display-1 text-center mt-5 mb-0" style="color: #0A3E52;">R.A.S.</p>
    <p class="h2 text-center mb-5" style="opacity: 0.5;" style="color: #0A3E52;">Report Attività Svolte</p> 
  
    <p class="pt-5">R.A.S. è una piattaforma che consente di gestire, organizzare e monitorare gli utenti, progetti e clienti dell'azienda. 
    Tutto con una semplice interfaccia che permette di memorizzare, modificare e cancellare dati all'interno di un database</p>
</div>
@endsection
