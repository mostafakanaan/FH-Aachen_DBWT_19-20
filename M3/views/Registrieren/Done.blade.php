@extends('app')
@section('pageTitle','Registrierung')
@section('content')
    <div class="row justify-content-center">
        <div class="col-5 alert alert-success">
            <p>Danke für die Registrierung. Ihre Benutzernummer ist {{$id}}</p>
        </div>
    </div>
@endsection