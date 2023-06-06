@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-10">
        <h2 class="text-center">Marketplace</h2>

        <dialog id="listingModal">
            <form>
              <!-- Your form fields go here -->
              <label for="title">Title:</label>
              <input type="text" id="title" name="title" required>
          
              <!-- Add more form fields as needed -->
          
              <button type="submit">Submit</button>
              <button type="button" onclick="document.getElementById('listingModal').close()">Cancel</button>
            </form>
          </dialog>
          
          <button class="btn btn-primary" type="button" onclick="document.getElementById('listingModal').showModal()">Make Listing</button>
          
        
    </div>    
</div>






@endsection

