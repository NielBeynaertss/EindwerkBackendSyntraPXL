@extends('auth.layouts')
@section('content')
<head>
<link rel="stylesheet" href="{{ asset('css/welcome.blade.css') }}">
</head>
<div class="header">
<h1>Welkom op de homepagina!</h1>
<p>Hieronder vind je de verschillende pagina's en wat ze doen, klik op een icoontje om er naar toe te gaan!</p>
<p>Let op, de meeste functionaliteiten zijn pas beschikbaar eens je registratie goedgekeurd is. Houd je mailbox de komende dagen in de gaten voor een bevestiging.</p>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="rounded p-4 infocard listings">
                <h2>Zoekertjes</h2> 
                <hr>
                <div>
                <div class="description">
                    <p>Hier kan je op zoek gaan naar materiaal om te lenen of huren. Je kan ook je eigen zoekertje plaatsen!</p>
                </div>
                <a href="{{ route('marketplace')}}">
                <div class="clickhere">
                    <p>klik hier!</p>
                    <i class="fa-solid fa-angles-down"></i>
                </div>
                <div class ="icon">
                    <i class="fa-solid fa-magnifying-glass"></i> 
                </div>
                </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="rounded p-4 infocard events">
                <h2>Evenementen</h2>
                <hr>
                <div class="description">
                    <p>Op deze pagina kan je opkomende events en hun informatie zien. Wil je zelf een evenement promoten? Dat kan hier ook!</p>
                </div>
                <a href="{{ route('events')}}">
                <div class="clickhere">
                    <p>klik hier!</p>
                    <i class="fa-solid fa-angles-down"></i>
                </div>
                <div class ="icon">
                    <i class="fa-regular fa-calendar-days"></i>
                </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="rounded p-4 infocard forum">
                <h2>Forum</h2>
                <hr>
                <div class="description">
                    <p>Heb je een vraag in verband met een jeugdvereniging gerelateerd onderwerp? Stel ze hier! Je kan hier ook deelnemen aan openlijke conversaties met andere gebruikers.</p>
                </div>
                <a href="{{ route('forum.recent')}}">
                <div class="clickhere">
                    <p>klik hier!</p>
                    <i class="fa-solid fa-angles-down"></i>
                </div>
                <div class ="icon">
                <i class="fa-solid fa-users"></i>
                </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="rounded p-4 infocard favorites">
                <h2>Favorieten</h2>
                <hr>
                <div class="description">
                    <p>Vind hier de events en zoekertjes die je hebt aangeduid als favoriet.</p>
                </div>
                <a href="{{ route('dashboard')}}">
                <div class="clickhere">
                    <p>klik hier!</p>
                    <i class="fa-solid fa-angles-down"></i>
                </div>
                <div class ="icon">
                    <i class="fa-solid fa-star"></i>
                </div>
                </a>
            </div>
        </div>
    </div>
@endsection