@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="row">
                <div class="col d-flex justify-content-between pb-3">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                        <i class="fa-solid fa-arrow-left"></i> Terug
                    </button>
                    
                    <h2 class="text-center">{{ $event->title }}</h2>

                    <form action="{{ route('addEventToFavorites') }}" method="post">
                        @csrf
                        <input type="hidden" name="eventId" value="{{ $event->id }}">
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-star"></i> 
                                Voeg toe aan favorieten
                        </button>                        
                    </form>
                </div>
                <hr>
            </div>
            <div class="row text-center">
                <div class="col text-center">
                    <img src="{{ asset('event-images/' . $event->picture) }}" alt="Event Image" style="width: 400px; height: auto;">
                </div>
            </div>

            <div class="row d-flex justify-content-center mt-5">
                <div class="col-6">
                    <h5><u>Beschrijving:</u> </h5>
                    <p class="bg-light">{{ $event->description }}</p>
                </div>
                <div class="row mt-5 border bg-light">
                    <div class="text-center pt-3">
                        <h5><u>Praktische informatie:</u></h5>
                    </div>
                    <div class="row">
                        <div class="col-4 text-center">
                            <p><b>Datum: </b> {{ $event->date }}</p>
                        </div>
                        <div class="col-4 text-center">
                            <p><b>Start om:</b> {{ $event->starttime }}</p>
                        </div>
                        <div class="col-4 text-center">
                            <p><b>Einde om:</b> {{ $event->endtime }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-center">
                            <p><b>Inkom:</b> €{{ $event->fee }}</p>
                        </div>
                        <div class="col-4 text-center">
                            <p><b>Adres:</b> {{ $event->location }}</p>
                        </div>
                        <div class="col-4 text-center">
                            <p><b>Georganiseerd door:</b> {{ $event->created_by }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
