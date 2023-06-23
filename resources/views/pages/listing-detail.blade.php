@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="row">
                <div class="col d-flex justify-content-between pb-3">
                    <!-- Add the back button -->
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </button>

                    <h2 class="text-center">{{ $listing->title }}</h2>

                    <form action="{{ route('addListingToFavorites') }}" method="post">
                        @csrf
                        <input type="hidden" name="listingId" value="{{ $listing->id }}">
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-star"></i> 
                            @if(in_array($listing->id, $member->favourite_listings ?? []))
                                Delete from Favorites
                            @else
                                Add to Favorites
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
                                    <p>No pictures available for this listing.</p>
                                </div>
                            @endif
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselPictures" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselPictures" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

            <p>Description: {{ $listing->description }}</p>
            <p>Location: {{ $listing->location }}</p>
            <p>Sell / Loan?: {{ $listing->type_of_transaction }}</p>
            <p>Sell / Loan?: €{{ $listing->price }}</p>
            <p>Created At: {{ $listing->created_at->format('d-m-y') }}</p>
            <p>Created by: {{ $listing->created_by }}</p>
            <p>Postcode: {{ $listing->postalcode }}</p> 
        </div>
    </div>
@endsection
