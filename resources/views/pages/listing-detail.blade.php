@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="row">
                <div class="col d-flex justify-content-between pb-3">
                    <!-- Add the back button -->
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                        <i class="fa-solid fa-arrow-left"></i> Terug
                    </button>

                    <h2 class="text-center">{{ $listing->title }}</h2>

                    <form action="{{ route('addListingToFavorites') }}" method="post">
                        @csrf
                        <input type="hidden" name="listingId" value="{{ $listing->id }}">
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-star"></i> 
                            @if(in_array($listing->id, $member->favourite_listings ?? []))
                                Verwijder uit favorieten
                            @else
                                Voeg toe aan favorieten
                            @endif
                        </button>                        
                    </form>
                </div>
                <hr>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-4">
                    <div id="carouselPictures" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @if ($listing->pictures)
                                @foreach ($listing->pictures as $index => $picture)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('listing-images/' . $picture) }}" alt="Listing Image" class="d-block w-100" style="height: 300px">
                                    </div>
                                @endforeach
                            @else
                                <div class="carousel-item active">
                                    <p>Geen fotos beschikbaar voor dit zoekertje.</p>
                                </div>
                            @endif
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselPictures" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Vorige</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselPictures" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Volgende</span>
                        </button>
                    </div>
                </div>
            </div>

            <p>Beschrijving: {{ $listing->description }}</p>
            <p>Adres: {{ $listing->location }}</p>
            <p>Verkoop / Lenen?: {{ $listing->type_of_transaction }}</p>
            <p>Prijs: €{{ $listing->price }}</p>
            <p>Postcode: {{ $listing->postalcode }}</p> 
        </div>
    </div>
@endsection
