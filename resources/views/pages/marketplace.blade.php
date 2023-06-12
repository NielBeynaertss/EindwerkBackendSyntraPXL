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
        transform: scale(1.07); /* Apply scale transformation on hover */
    }
    dialog{
        width: 600px;
    }
</style>

<div class="row justify-content-center mt-5">
    <div class="col-md-10">


        <div class="row">
            <h2 class="text-center">Marketplace</h2>
        </div>

        <div class="row mt-5">
            <div class="col d-flex justify-content-end">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-filter"></i> Filters
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li><a class="dropdown-item" href="#">Alphabetical</a></li>
                      <li><a class="dropdown-item" href="#">Only sell</a></li>
                      <li><a class="dropdown-item" href="#">Only loan</a></li>
                    </ul>
                </div>
                <div class="col-2 d-flex justify-content-end ml-2">
                    <button class="btn btn-primary" type="button" onclick="document.getElementById('createListingDialog').showModal()">Make Listing</button>
                </div>
            </div>

        </div>

        <!--Create listing popup-->
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
                            <option value="Loan">Loan</option>
                            <option value="Sell">Sell</option>
                        </select><br><br>
                        
                        <input type="text" id="location" name="location" required><br><br>
                        <textarea type="text" id="description" name="description" required></textarea><br><br>
                    </div>
                </div>
                <button type="submit">Submit</button>
                <button type="button" onclick="document.getElementById('createListingDialog').close()">Cancel</button>
            </form>
        </dialog>

        <div class="row mt-3">
            @foreach($listings as $listing)
                <div class="col-lg-4 mb-3">
                    <a href="{{ route('listingDetail', ['id' => $listing->id]) }}" class="text-decoration-none">
                        <div class="card listing-card">
                            <div class="card-body" style="height: 150px">
                                <div class="row">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title">{{ $listing->title }}</h5>
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <a href="#" class="favorite-icon">
                                                <i class="favorite-icon fa-solid fa-star"></i>
                                            </a>
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
                {{ $listings->links() }}
            </div>
        </div>
        
    </div>    
</div>



@endsection
