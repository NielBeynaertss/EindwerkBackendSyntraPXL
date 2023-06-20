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
            @foreach ($listing->pictures as $picture)
                <img src="{{ asset('listing-images/' . $picture) }}" alt="Listing Image" class="img-fluid">
            @endforeach
            <p>Description: {{ $listing->description }}</p>
            <p>Location: {{ $listing->location }}</p>
            <p>Sell / Loan?: {{ $listing->type_of_transaction }}</p>
            <p>Created At: {{ $listing->created_at->format('d-m-y') }}</p>
            <p>Created by: {{ $listing->created_by }}</p>
            <p>Postcode: {{ $listing->postalcode }}</p> 
        </div>
    </div>
@endsection
