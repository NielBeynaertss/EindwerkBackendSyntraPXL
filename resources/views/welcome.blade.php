@extends('auth.layouts')
@section('content')
<head>
<link rel="stylesheet" href="{{ asset('css/welcome.blade.css') }}">
</head>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="rounded p-4 infocard">
            <div class ="icon">
                    
            </div>
                <h2>Zoekertjes</h2>
                <p>Hier kan je op zoek gaan naar materiaal om te lenen of huren. Je kan ook je eigen zoekertje plaatsen!</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="rounded p-4 infocard">
                <div class ="icon">
                    
                </div>
                <h2>Events</h2>
                <p>Op deze pagina kan je opkomende events en hun informatie zien. Wil je zelf een evenement promoten? Dat kan hier ook!</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="rounded p-4 infocard">
            <div class ="icon">
                    
            </div>
                <h2>Forum</h2>
                <p>Heb je een vraag in verband met een jeugdvereniging gerelateerd onderwerp? Stel ze hier! Je kan hier ook deelnemen aan openlijke conversaties met andere gebruikers.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="rounded p-4 infocard favorite">
            <div class ="icon">
                    
            </div>
                <h2>Favorieten</h2>
                <p>Vind hier de events en zoekertjes die je hebt aangeduid als favoriet.</p>
            </div>
        </div>
    </div>
@endsection