@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="row">
                <div class="col d-flex justify-content-between pb-3">
                    <h2 class="text-center">{{ $listing->title }}</h2>

                    <form action="{{ route('addToFavorites') }}" method="post">
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
            <p>Description: {{ $listing->description }}</p>
            <p>Location: {{ $listing->location }}</p>
            <p>Sell / Loan?: {{ $listing->type_of_transaction }}</p>
            <p>Created At: {{ $listing->created_at->format('d-m-y') }}</p>
            <p>Created by: {{ $listing->created_by }}</p>
        </div>
    </div>
@endsection
