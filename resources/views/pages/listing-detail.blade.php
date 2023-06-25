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
                                Voeg toe aan favorieten
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

            <div class="row d-flex justify-content-center mt-5">
                <div class="col-6">
                    <h5><u>Beschrijving:</u> </h5>
                    <p class="bg-light">{{ $listing->description }}</p>
                </div>
                <div class="row mt-5 border bg-light">
                    <div class="text-center">
                        <h5><u>Praktische informatie:</u></h5>
                    </div>
                    <div class="col-6 text-center">
                        <p><b>Verkoop / Lenen?:</b> {{ $listing->type_of_transaction }}</p>
                        <p><b>Prijs:</b> €{{ $listing->price }}</p>
                        <p><b>Categorie:</b> {{ $listing->category }}</p>
                    </div>
                    <div class="col-6 text-center">
                        <p><b>Stad / gemeente:</b> {{ $listing->city }}</p>
                        <p><b>Postcode:</b> {{ $listing->postalcode }}</p> 
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
