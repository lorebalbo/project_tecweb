@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Inserisci un nuovo cliente</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="" method="">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="contact_name">Nome Referente</label>
            <input type="text" class="form-control" name="contact_name" id="contact_name">
            <small class="form-text text-muted">Inserisci il nome del referente</small>
        </div>

        <div class="form-group">
            <label for="contact_surname">Cognome Referente</label>
            <input type="text" class="form-control" name="contact_surname" id="contact_surname">
            <small class="form-text text-muted">Inserisci il cognome del referente</small>
        </div>

        <div class="form-group">
            <label for="contact_email">Email Referente</label>
            <input type="text" class="form-control" name="contact_email" id="contact_email">
            <small class="form-text text-muted">Inserisci l'email del referente'</small>
        </div>

        <div class="form-group">
            <label for="business_name">Ragione Sociale</label>
            <input type="text" class="form-control" name="business_name" id="business_name">
            <small class="form-text text-muted">Inserisci la ragione sociale</small>
        </div>

        <button id="add-class-btn" type="submit" class="btn btn-primary" >Salva</button>
        <a href="{{ URL::action('ClientController@index') }}" class="btn btn-secondary">Indietro</a>
    </form>
</div>

<script type="text/javascript">
    $('document').ready(function() {
        $('#add-class-btn').bind('click', function(e) {
            e.preventDefault();

            var contact_name = $('#contact_name').val();
            var contact_surname = $('#contact_surname').val();
            var contact_email = $('#contact_email').val();
            var business_name = $('#business_name').val();
            var _token = $('#_token').val();
            //console.log(contact_name);

            if(contact_name.length > 0) {
                $.ajax({
                    url: "/admin/client", 
                    type: "POST",
                    dataType: "json",
                    data: { 'contact_name': contact_name, 'contact_surname': contact_surname, 'contact_email': contact_email, 'business_name': business_name, '_token': _token },
                    success: function(data) {
                        console.log(data);

                        if (data.status === 'ok'){
                            console.log('Hey!');
                        }
                        window.location.href = "/admin/client";
                    }, 
                    error: function(response, stato) {
                        console.log(stato);
                    }
                });
            }
        });
        
        
    });
</script>

@endsection