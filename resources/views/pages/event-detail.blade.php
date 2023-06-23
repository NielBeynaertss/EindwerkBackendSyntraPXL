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
                            @if(in_array($event->id, $member->favourite_listings ?? []))
                                Verwijder uit favorieten
                            @else
                                Voeg toe aan favorieten
                            @endif
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
            <p>Beschrijving: {{ $event->description }}</p>
            <p>Adres: {{ $event->location }}</p>
            <p>Kost?: {{ $event->fee }}</p>
        </div>
    </div>
@endsection
