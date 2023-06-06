@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-10">
        <h2 class="text-center">Marketplace</h2>
        <button class="btn btn-primary" type="button" onclick="document.getElementById('listingModal').showModal()">Make Listing</button>

        <dialog id="listingModal">
            <form>
                <div class="row">
                    <div class="col">
                        <label for="title">Item:</label><br><br>
                        <label for="title">Category:</label><br><br>
                        <label for="type">Type of Transaction:</label><br><br>
                        <label for="city">Stad / Gemeente:</label><br><br>
                        <label for="description">Beschrijving:</label><br><br>
                    </div>
                    <div class="col">
                        <input type="text" id="item" name="item" required><br><br>
                        <select id="category" name="category" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select><br><br>
                        <select id="type" name="type" required>
                            @foreach($typeOfTransactions as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select><br><br>
                        <input type="text" id="city" name="city" required><br><br>
                        <input type="text" id="description" name="description" required><br><br>
                    </div>
                </div>
                <button type="submit">Submit</button>
                <button type="button" onclick="document.getElementById('listingModal').close()">Cancel</button>
            </form>
        </dialog>
    </div>    
</div>

@endsection
