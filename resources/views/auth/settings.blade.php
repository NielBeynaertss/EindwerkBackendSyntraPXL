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
                        <button type="button" onclick="document.getElementById('CredentialsDialog').showModal()">Toon informatie</button>
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
                    <button type="button" onclick="document.getElementById('changeCredentialsDialog').showModal()">Wijzig gebruikers informatie</button>
                    <button type="button" onclick="document.getElementById('changePasswordDialog').showModal()">Wijzig wachtwoord</button>
                </div>
                <div class="col">
                    <button type="button" onclick="document.getElementById('CredentialsDialog').close()">Sluit</button>
                </div>
            </div>

        </dialog>


        <!--Edit credentials dialogs-->
        <div>

            <dialog id="changeCredentialsDialog">
                <form action="{{ route('updateCredentials') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md">
                            <label for="lastname">Achternaam:</label>
                        </div>
                        <div class="col">
                            <input type="text" name="lastname" value="{{ Auth::user()->lastname }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="firstname">Voornaam:</label>
                        </div>
                        <div class="col">
                            <input type="text" name="firstname" value="{{ Auth::user()->firstname }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="email">Email adress:</label>
                        </div>
                        <div class="col">
                            <input type="text" name="email" value="{{ Auth::user()->email }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="phone">GSM:</label>
                        </div>
                        <div class="col">
                            <input type="text" name="phone" value="{{ Auth::user()->phone }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="streetnr">Straat + nummer:</label>
                        </div>
                        <div class="col">
                            <input type="text" name="streetnr" value="{{ Auth::user()->streetnr }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="city">Stad / gemeente:</label>
                        </div>
                        <div class="col">
                            <input type="text" name="city" value="{{ Auth::user()->city }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="postalcode">Postcode:</label>
                        </div>
                        <div class="col">
                            <input type="text" name="postalcode" value="{{ Auth::user()->postalcode }}" required>
                        </div>
                    </div>

                    <button type="submit">Bewaar</button>
                    <button type="button" onclick="document.getElementById('changeCredentialsDialog').close()">Annuleer</button>
                </form>
            </dialog>
            

            <dialog id="changePasswordDialog">
                <form action="{{ route('updatePassword') }}" method="post">
                    @csrf
                    <label for="password">Nieuw paswoord: </label>
                    <input type="password" id="password" name="password"><br><br>

                    <label for="password">Bevestig paswoord: </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror               

                    <button type="submit">Bewaar</button>
                    <button type="button" onclick="document.getElementById('changePasswordDialog').close()">Annuleer</button>
                </form>
            </dialog>

        </div>

    </div>    
</div>

@endsection
