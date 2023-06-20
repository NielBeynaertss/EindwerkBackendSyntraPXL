@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="row">
                <div class="col d-flex justify-content-between pb-3">
                    <h2 class="text-center">{{ $event->title }}</h2>

                    <form action="{{ route('addEventToFavorites') }}" method="post">
                        @csrf
                        <input type="hidden" name="eventId" value="{{ $event->id }}">
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-star"></i> 
                            @if(in_array($event->id, $member->favourite_listings ?? []))
                                Delete from Favorites
                            @else
                                Add to Favorites
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
            <p>Description: {{ $event->description }}</p>
            <p>Location: {{ $event->location }}</p>
            <p>Fee?: {{ $event->fee }}</p>
            <p>Created At: {{ $event->created_at->format('d-m-y') }}</p>
            <p>Created by: {{ $event->created_by }}</p>
        </div>
    </div>
@endsection
