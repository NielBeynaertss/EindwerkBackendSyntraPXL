@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <h2 class="text-center">{{ $listing->title }}</h2>
            <p>Description: {{ $listing->description }}</p>
            <p>Location: {{ $listing->location }}</p>
            <p>Sell / Loan?: {{ $listing->type_of_transaction }}</p>
        </div>
    </div>
@endsection
