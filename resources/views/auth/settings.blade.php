@extends('auth.layouts')

@section('content')

<style>
    dialog{
        width: 800px;
    }
    .profile_button{
        padding: 0;
    }
    .profile_button {
        background-color: transparent;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .profile_button:hover {
        background-color: #f5f5f5;
    }

    .profile_button_text {
        display: none;
        color: gray;
        font-size: 14px;
        margin-top: 5px;
    }

    .profile_button:hover .profile_button_text {
        display: block;
    }


</style>

<div class="row justify-content-center mt-5">
    <div class="col-md-10">
                
        <div class="text-center">
            @if (Auth::user()->profile_picture)
                <button type="button" onclick="document.getElementById('profilePictureDialog').showModal()" class="profile_button">
                    <img src="{{ asset('profile-images/' . Auth::user()->profile_picture) }}" alt="Profile Picture" height="400px;">
                    <span class="profile_button_text">Klik hier om profiel foto toe te voegen / te veranderen</span>
                </button>
            @else
                <button type="button" onclick="document.getElementById('profilePictureDialog').showModal()" class="profile_button">
                    <img src="{{ asset('profile-images/default-image.jpg')}}" alt="default profile picture" height="400px;">
                    <span class="profile_button_text">Klik hier om profiel foto toe te voegen</span>
                </button>
            @endif
        </div>
                         
        <dialog id="profilePictureDialog">
            <form action="{{ route('updateProfilePicture') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="profile_picture"><br>
                <button type="submit">Upload profiel foto</button>
            </form><br>             
            <button type="button" onclick="document.getElementById('profilePictureDialog').close()">Sluit</button>
        </dialog>

        <hr>
        
        <div class="card">
            <div class="card-header">
                <div class="row ">
                    <div class="col">
                        <p class="mt-3">Gebruikers informatie</p>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <button type="button" onclick="document.getElementById('CredentialsDialog').showModal()" class="btn btn-primary">Toon informatie</button>
                    </div>
                </div>
                
            </div>
        </div>
        

        <dialog id="CredentialsDialog">

            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-md">
                            <p><b>Achternaam:</b></p>
                        </div>
                        <div class="col">
                            <p>{{ Auth::user()->lastname}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p><b>Voornaam:</b></p>
                        </div>
                        <div class="col">
                            <p>{{ Auth::user()->firstname}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p><b>Email adress</b></p>
                        </div>
                        <div class="col">
                            <p>{{ Auth::user()->email}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p><b>GSM</b></p>
                        </div>
                        <div class="col">
                            <p>{{ Auth::user()->phone}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p><b>Straat + nummer</b></p>
                        </div>
                        <div class="col">
                            <p>{{ Auth::user()->streetnr}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p><b>Stad / gemeente</b></p>
                        </div>
                        <div class="col">
                            <p>{{ Auth::user()->city}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p><b>Postcode</b></p>
                        </div>
                        <div class="col">
                            <p>{{ Auth::user()->postalcode}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p><b>Wachtwoord</b></p>
                        </div>
                        <div class="col">
                            <p>********</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="button" onclick="document.getElementById('changeCredentialsDialog').showModal()" class="btn btn-primary">Wijzig gebruikers informatie</button>
                    <button type="button" onclick="document.getElementById('changePasswordDialog').showModal()" class="btn btn-primary mt-3">Wijzig wachtwoord</button>
                </div>
                <div class="col">
                    <button type="button" onclick="document.getElementById('CredentialsDialog').close()" class="btn btn-secondary">Sluit</button>
                </div>
            </div>

        </dialog>


        <!--Edit credentials dialogs-->
        <div>

            <dialog id="changeCredentialsDialog">
                <form action="{{ route('updateCredentials') }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="lastname" class="form-label">Achternaam:</label>
                        </div>
                        <div class="col">
                            <input type="text" name="lastname" value="{{ Auth::user()->lastname }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="firstname" class="form-label">Voornaam:</label>
                        </div>
                        <div class="col">
                            <input type="text" name="firstname" value="{{ Auth::user()->firstname }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="email" class="form-label">Email adres:</label>
                        </div>
                        <div class="col">
                            <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="phone" class="form-label">GSM:</label>
                        </div>
                        <div class="col">
                            <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="streetnr" class="form-label">Straat + nummer:</label>
                        </div>
                        <div class="col">
                            <input type="text" name="streetnr" value="{{ Auth::user()->streetnr }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="city" class="form-label">Stad / gemeente:</label>
                        </div>
                        <div class="col">
                            <input type="text" name="city" value="{{ Auth::user()->city }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="postalcode" class="form-label">Postcode:</label>
                        </div>
                        <div class="col">
                            <input type="text" name="postalcode" value="{{ Auth::user()->postalcode }}" class="form-control" required>
                        </div>
                    </div>
            
                    <button type="submit" class="btn btn-primary">Bewaar</button>
                    <button type="button" onclick="document.getElementById('changeCredentialsDialog').close()" class="btn btn-secondary">Annuleer</button>
                </form>
            </dialog>
            

            <dialog id="changePasswordDialog">
                <form action="{{ route('updatePassword') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="password" class="form-label">Nieuw paswoord:</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
            
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Bevestig paswoord:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <button type="submit" class="btn btn-primary">Bewaar</button>
                    <button type="button" onclick="document.getElementById('changePasswordDialog').close()" class="btn btn-secondary">Annuleer</button>
                </form>
            </dialog>
            

        </div>

    </div>    
</div>

@endsection
