@extends('auth.layouts')

@section('content')
<style>
    .favorite-icon {
        color: #888; /* Default color */
        cursor: pointer;
    }
    .favorite-icon.active {
        color: red; /* Color when active */
    }
    .listing-card {
        transition: transform 0.3s; /* Add transition for smooth effect */
    }
    .listing-card:hover {
        transform: scale(1.05); /* Apply scale transformation on hover */
    }
</style>

<div class="row justify-content-center mt-5">
    <div class="col-md-10">
        <h2 class="text-center">Marketplace</h2>
        <button class="btn btn-primary" type="button" onclick="document.getElementById('createListingDialog').showModal()">Make Listing</button>

        <dialog id="createListingDialog">
            <form action="{{ route('storeListing') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <label for="title">Item:</label><br><br>
                        <label for="category">Category:</label><br><br>
                        <label for="typeOfTransaction">Type of Transaction:</label><br><br>
                        <label for="location">Stad / Gemeente:</label><br><br>
                        <label for="description">Beschrijving:</label><br><br>
                    </div>
                    <div class="col">
                        <input type="text" id="title" name="title" required><br><br>
                        
                        <select id="category" name="category" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select><br><br>
                        
                        <select id="typeOfTransaction" name="typeOfTransaction" required>
                            @foreach($typeOfTransactions as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select><br><br>
                        
                        <input type="text" id="location" name="location" required><br><br>
                        <textarea type="text" id="description" name="description" required></textarea><br><br>
                    </div>
                </div>
                <button type="submit">Submit</button>
                <button type="button" onclick="document.getElementById('createListingDialog').close()">Cancel</button>
            </form>
        </dialog>


        <div class="mt-5">
            <h3>Listings</h3>
            <div class="row">
                @foreach($listings as $listing)
                    <div class="col-md-4 mb-3">
                        <div class="card listing-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title">{{ $listing->title }}</h5>
                                    </div>
                                    <div class="col d-flex justify-content-end">
                                        <a href="#" class="favorite-icon">
                                            <i class="favorite-icon fa-solid fa-star"></i>
                                        </a>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p class="card-text">{{ $listing->description }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add a button to trigger the dialog -->
                                <button type="button" class="btn btn-primary" onclick="openDialog('{{ $listing->title }}', '{{ $listing->description }}')">View Details</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <!-- Dialog -->
        <dialog id="listingDetailsDiaglog">
            <h2 id="listingDetailsDiaglogTitle"></h2>
            <p id="listingDetailsDiaglogDescription"></p>
            <button type="button" onclick="document.getElementById('listingDetailsDiaglog').close()">Cancel</button>
        </dialog>
        

    </div>    
</div>

<script>
    // Open the dialog and set the title and description
    function openDialog(title, description) {
        document.getElementById('listingDetailsDiaglogTitle').textContent = title;
        document.getElementById('listingDetailsDiaglogDescription').textContent = description;
        document.getElementById('listingDetailsDiaglog').showModal();
    }
</script>


@endsection
