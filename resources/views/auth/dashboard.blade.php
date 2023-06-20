@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-10">
        <h2 class="text-center">Dashboard</h2>
        <hr>
        <div class="row">

            <div class="col">
                <div class="card">
                    <h5 class="card-header">Favourite listings</h5>
                    <div class="card-body" style="height: 500px; overflow-y:scroll;">
                        @foreach(json_decode(Auth::user()->favourite_listings) as $listingId)
                            @php
                                $listing = App\Models\Listing::find($listingId);
                            @endphp
                            <div class="border mb-3">
                                <h5 class="card-title">{{ $listing->title }}</h5>
                                <p class="card-text">{{ $listing->description }}</p>
                                <a href="#" class="btn btn-primary">View Listing</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <h5 class="card-header">Favourite events</h5>
                    <div class="card-body" style="height: 500px; overflow-y:scroll;">
                        @foreach(json_decode(Auth::user()->favourite_events) as $eventId)
                            @php
                                $event = App\Models\Event::find($eventId);
                            @endphp
                            <div class="border mb-3">
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <p class="card-text">{{ $event->description }}</p>
                                <a href="#" class="btn btn-primary">View event</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>    
</div>

@endsection
