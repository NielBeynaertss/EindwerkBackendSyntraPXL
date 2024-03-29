@extends('auth.layouts')

@section('content')

<style>
    #favoriteIcon {
        color: #888; /* Default color */
        cursor: pointer;
    }
    #favoriteIcon.active {
        color: red; /* Color when active */
    }
    .listing-card {
        transition: transform 0.3s; /* Add transition for smooth effect */
    }
    .listing-card:hover {
        transform: scale(1.07); /* Apply scale transformation on hover */
    }
    dialog{
        width: 600px;
    }
</style>

<div class="row justify-content-center mt-5">
    <div class="col-md-10">


        <div class="row">
            <h2 class="text-center">Marktplaats</h2>
        </div>
        <hr>
        <div class="row mt-5">
            <div class="col d-flex justify-content-end">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-filter"></i> Filters
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('marketplace', array_merge(request()->query(), ['filter' => 'ascending'])) }}">Alphabetical | ASC</a></li>
                        <li><a class="dropdown-item" href="{{ route('marketplace', array_merge(request()->query(), ['filter' => 'descending'])) }}">Alphabetical | DESC</a></li>
                        <li><a class="dropdown-item" href="{{ route('marketplace', array_merge(request()->query(), ['filter' => 'only_sell'])) }}">Only sell</a></li>
                        <li><a class="dropdown-item" href="{{ route('marketplace', array_merge(request()->query(), ['filter' => 'only_loan'])) }}">Only loan</a></li>                        
                    </ul>   
                    <a href="{{ route('clearFilters') }}">Clear Filters</a>                
                </div>
                <div class="col-2 d-flex justify-content-end ml-2">
                    <button class="btn btn-primary" type="button" onclick="document.getElementById('createListingDialog').showModal()">Make Listing</button>
                </div>
            </div>
        </div>
        

        <!--Create listing popup-->
        <dialog id="createListingDialog">
        <form action="{{ route('storeListing') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <label for="title" class="form-label">Item:</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label for="category" class="form-label">Categorie:</label>
            <select id="category" name="category" class="form-select" required>
                <option value="Antiek en Kunst">Antiek en Kunst</option>
                <option value="Antiek en Kunst">Antiek en Kunst</option>
                                <option value="Audio, Tv en Foto">Audio, Tv en Foto</option>
                                <option value="Auto diversen">Auto diversen</option>
                                <option value="Auto's">Auto's</option>
                                <option value="Auto-onderdelen">Auto-onderdelen</option>
                                <option value="Boeken">Boeken</option>
                                <option value="Caravans en Kamperen">Caravans en Kamperen</option>
                                <option value="Cd's en Dvd's">Cd's en Dvd's</option>
                                <option value="Computers en Software">Computers en Software</option>
                                <option value="Contacten en Berichten">Contacten en Berichten</option>
                                <option value="Diensten en Vakmensen">Diensten en Vakmensen</option>
                                <option value="Dieren en Toebehoren">Dieren en Toebehoren</option>
                                <option value="Doe-het-zelf en Bouw">Doe-het-zelf en Bouw</option>
                                <option value="Elektronische apparatuur">Elektronische apparatuur</option>
                                <option value="Fietsen en Brommers">Fietsen en Brommers</option>
                                <option value="Games en Spelcomputers">Games en Spelcomputers</option>
                                <option value="Handtassen en Accessoires">Handtassen en Accessoires</option>
                                <option value="Hobby en Vrije tijd">Hobby en Vrije tijd</option>
                                <option value="Huis en Inrichting">Huis en Inrichting</option>
                                <option value="Immo">Immo</option>
                                <option value="Kinderen en Baby's">Kinderen en Baby's</option>
                                <option value="Kleding | Dames">Kleding | Dames</option>
                                <option value="Kleding | Heren">Kleding | Heren</option>
                                <option value="Motoren">Motoren</option>
                                <option value="Muziek en Instrumenten">Muziek en Instrumenten</option>
                                <option value="Postzegels en Munten">Postzegels en Munten</option>
                                <option value="Sport en Fitness">Sport en Fitness</option>
                                <option value="Telecommunicatie">Telecommunicatie</option>
                                <option value="Tickets en Kaartjes">Tickets en Kaartjes</option>
                                <option value="Tuin en Terras">Tuin en Terras</option>
                                <option value="Vacatures">Vacatures</option>
                                <option value="Vakantie">Vakantie</option>
                                <option value="Verzamelen">Verzamelen</option>
                                <option value="Watersport en Boten">Watersport en Boten</option>
                                <option value="Zakelijke goederen">Zakelijke goederen</option>
                <option value="Zakelijke goederen">Zakelijke goederen</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="typeOfTransaction" class="form-label">Verkopen / lenen:</label>
            <select id="typeOfTransaction" name="typeOfTransaction" class="form-select" required>
                <option value="Loan">Lenen</option>
                <option value="Sell">Verkopen</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="price" class="form-label">Prijs:</label>
            <input type="number" step="0.5" id="price" name="price" class="form-control" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="city" class="form-label">Stad / Gemeente:</label>
            <input type="text" id="city" name="city" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label for="postalcode" class="form-label">Postcode:</label>
            <input type="text" id="postalcode" name="postalcode" class="form-control" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="description" class="form-label">Beschrijving:</label>
            <textarea id="description" name="description" class="form-control" required></textarea>
        </div>
        <div class="col-md-6">
            <label for="pictures" class="form-label">Afbeeldingen:</label>
            <input type="file" id="pictures" name="pictures[]" class="form-control" multiple>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <button type="submit" class="btn btn-primary">Bewaar</button>
            <button type="button" class="btn btn-secondary" onclick="document.getElementById('createListingDialog').close()">Annuleren</button>
        </div>
    </div>
</form>

        </dialog>

        <div class="row mt-3">
            @foreach($listings as $listing)
                <div class="col-lg-4 mb-3">
                    <a href="{{ route('listingDetail', ['id' => $listing->id]) }}" class="text-decoration-none">
                        <div class="card listing-card">
                            <div class="card-body row" style="height: 150px">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title">{{ $listing->title }}</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p class="card-text">{{ $listing->category }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p class="card-text">{{ $listing->type_of_transaction }}</p>
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
                {{ $listings->appends(request()->query())->links() }}
            </div>
        </div>
        
    </div>    
</div>





@endsection
