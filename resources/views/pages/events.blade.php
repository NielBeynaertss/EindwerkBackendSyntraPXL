@extends('auth.layouts')

@section('content')
<style>
    dialog{
        width: 600px;
    }
    .event-image {
        width: 300px; /* Set the desired width */
        height: 300px; /* Set the desired height */
        object-fit: cover;
    }
</style>
<head>
<link rel="stylesheet" href="{{ asset('css/events.blade.css') }}">
</head>

<div class="row justify-content-center mt-5">
    <div class="col-md-10">
        <div class="row">
            <h2 class="text-center">Evenementen</h2>
        </div>
        <hr>
        <div class="row mt-5">
            <div class="col d-flex justify-content-end">
                <div class="col-2 d-flex justify-content-end ml-2">
                    <button class="btn btn-primary btn-make-event" type="button" onclick="document.getElementById('proposeEventDialog').showModal()">Evenement voorstellen</button>
                </div>
            </div>
        </div>
        
        <!--Create listing popup-->
        <dialog id="proposeEventDialog">
            <form action="{{ route('storeEvent') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="row">
                        <div class="col">
                            <label for="title">Evenement naam:</label><br><br>
                        </div>
                        <div class="col">
                            <input type="text" id="title" name="title" required><br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="location">Locatie:</label><br><br>
                        </div>
                        <div class="col">
                            <input type="text" id="location" name="location" required><br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="postalcode">Postcode:</label><br><br>
                        </div>
                        <div class="col">
                            <input type="text" id="postalcode" name="postalcode" required><br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="date">Datum:</label><br><br>
                        </div>
                        <div class="col">
                            <input type="date" id="date" name="date" required><br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="starttime">Startuur:</label><br><br>
                        </div>
                        <div class="col">
                            <input type="time" id="starttime" name="starttime" required><br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="endtime">Einduur:</label><br><br>
                        </div>
                        <div class="col">
                            <input type="time" id="endtime" name="endtime" required><br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="fee">Kostprijs:</label><br><br>
                        </div>
                        <div class="col">
                            <input type="number" step="0.5" id="fee" name="fee" required><br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="description">Beschrijving:</label><br><br>
                        </div>
                        <div class="col">
                            <textarea id="description" name="description" required></textarea><br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="picture">Afbeelding:</label><br><br>
                        </div>
                        <div class="col">
                            <input type="file" id="picture" name="picture"><br><br>
                        </div>
                    </div>
                </div>
                <button type="submit">Bewaar</button>
                <button type="button" onclick="document.getElementById('proposeEventDialog').close()">Annuleer</button>
            </form>            
        </dialog>
        

        <div class="row mt-3">
            @foreach($events as $event)
                <div class="col-lg-6 mb-3">
                    <a href="{{ route('eventDetail', ['id' => $event->id]) }}" class="text-decoration-none">
                        <div class="card listing-card">
                            <div class="card-body row" style="height: 500px">
                                <div class="col">
                                    <div class="row" style="height: 300px">
                                        <div class="col text-center align-middle">
                                            <img src="{{ asset('event-images/' . $event->picture) }}" alt="Event Image" class="event-image">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title">{{ $event->title }}</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p class="card-text">{{ $event->location }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p class="card-text">{{ $event->date }}</p>
                                        </div>
                                    </div>                                                                        
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <!-- Display pagination links -->
                {{ $events->appends(request()->query())->links() }}
            </div>
        </div>
        
        
    </div>
</div>

@endsection