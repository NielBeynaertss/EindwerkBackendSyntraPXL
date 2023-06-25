@extends('auth.layouts')
@section('content')
<head>
<link rel="stylesheet" href="{{ asset('css/welcome.blade.css') }}">
</head>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="rounded p-4 infocard listings">
                <h2>Zoekertjes</h2> 
                <div>
                <div class="description">
                    <p>Hier kan je op zoek gaan naar materiaal om te lenen of huren. Je kan ook je eigen zoekertje plaatsen!</p>
                </div>
                <div class ="icon">
                    <i class="fa-solid fa-magnifying-glass"></i> 
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="rounded p-4 infocard events">
                <h2>Events</h2>
                <div class="description">
                    <p>Op deze pagina kan je opkomende events en hun informatie zien. Wil je zelf een evenement promoten? Dat kan hier ook!</p>
                </div>
                <div class ="icon">
                    <i class="fa-regular fa-calendar-days"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="rounded p-4 infocard forum">
                <h2>Forum</h2>
                <div class="description">
                    <p>Heb je een vraag in verband met een jeugdvereniging gerelateerd onderwerp? Stel ze hier! Je kan hier ook deelnemen aan openlijke conversaties met andere gebruikers.</p>
                </div>
                <div class ="icon">
                <i class="fa-solid fa-users"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="rounded p-4 infocard favorites">
                <h2>Favorieten</h2>
                <div class="description">
                    <p>Vind hier de events en zoekertjes die je hebt aangeduid als favoriet.</p>
                </div>
                <div class ="icon">
                    <i class="fa-solid fa-star"></i>
                </div>
            </div>
        </div>
    </div>
@endsection