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
                    <span class="profile_button_text">Click to add/change profile picture</span>
                </button>
            @else
                <button type="button" onclick="document.getElementById('profilePictureDialog').showModal()" class="profile_button">
                    <img src="{{ asset('profile-images/default-image.jpg')}}" alt="default profile picture" height="400px;">
                    <span class="profile_button_text">Click to add/change profile picture</span>
                </button>
            @endif
        </div>
                         
        <dialog id="profilePictureDialog">
            <form action="{{ route('updateProfilePicture') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="profile_picture"><br>
                <button type="submit">Upload Profile Picture</button>
            </form><br>             
            <button type="button" onclick="document.getElementById('profilePictureDialog').close()">Close</button>
        </dialog>

        <hr>
        
        <div class="card">
            <div class="card-header">
                <div class="row ">
                    <div class="col">
                        <p class="mt-3">User Information</p>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <button type="button" onclick="document.getElementById('changeCredentialsDialog').showModal()">Show info</button>
                    </div>
                </div>
                
            </div>
        </div>
        

        <dialog id="changeCredentialsDialog">

            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-md">
                            <p><b>Achternaam:</b></p>
                        </div>
                        <div class="col">
                            <p>{{ Auth::user()->lastname}}</p>
                        </div>
                        <div class="col">
                            <p><a onclick="document.getElementById('changeAchternaamDialog').showModal(); document.getElementById('changeCredentialsDialog').close()"><i class="fa-solid fa-pen-to-square"></i></a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p><b>Voornaam:</b></p>
                        </div>
                        <div class="col">
                            <p>{{ Auth::user()->firstname}}</p>
                        </div>
                        <div class="col">
                            <p><a onclick="document.getElementById('changeVoornaamDialog').showModal(); document.getElementById('changeCredentialsDialog').close()"><i class="fa-solid fa-pen-to-square"></i></a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p><b>Email adress</b></p>
                        </div>
                        <div class="col">
                            <p>{{ Auth::user()->email}}</p>
                        </div>
                        <div class="col">
                            <p><a onclick="document.getElementById('changeEmailDialog').showModal(); document.getElementById('changeCredentialsDialog').close()"><i class="fa-solid fa-pen-to-square"></i></a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p><b>GSM</b></p>
                        </div>
                        <div class="col">
                            <p>{{ Auth::user()->phone}}</p>
                        </div>
                        <div class="col">
                            <p><a onclick="document.getElementById('changePhoneDialog').showModal(); document.getElementById('changeCredentialsDialog').close()""><i class="fa-solid fa-pen-to-square"></i></a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p><b>Straat + nummer</b></p>
                        </div>
                        <div class="col">
                            <p>{{ Auth::user()->streetnr}}</p>
                        </div>
                        <div class="col">
                            <p><a onclick="document.getElementById('changeStreetnrDialog').showModal(); document.getElementById('changeCredentialsDialog').close()""><i class="fa-solid fa-pen-to-square"></i></a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p><b>Stad / gemeente</b></p>
                        </div>
                        <div class="col">
                            <p>{{ Auth::user()->city}}</p>
                        </div>
                        <div class="col">
                            <p><a onclick="document.getElementById('changeCityDialog').showModal(); document.getElementById('changeCredentialsDialog').close()""><i class="fa-solid fa-pen-to-square"></i></a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p><b>Wachtwoord</b></p>
                        </div>
                        <div class="col">
                            <p>********</p>
                        </div>
                        <div class="col">
                            <p><a onclick="document.getElementById('changePasswordDialog').showModal(); document.getElementById('changeCredentialsDialog').close()""><i class="fa-solid fa-pen-to-square"></i></a></p>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" onclick="document.getElementById('changeCredentialsDialog').close()">Cancel</button>

        </dialog>


        <!--Edit credentials dialogs-->
        <div>
            <dialog id="changeAchternaamDialog">
                <form action="{{ route('updateCredentials', ['id' => 'lastname']) }}" method="post">
                    @csrf
                    <label for="lastname">Nieuwe achternaam</label>
                    <input type="text" id="lastname" name="lastname">
                    <button type="submit">Submit</button>
                    <button type="button" onclick="document.getElementById('changeAchternaamDialog').close()">Cancel</button>
                </form>
            </dialog>
            
            <dialog id="changeVoornaamDialog">
                <form action="{{ route('updateCredentials', ['id' => 'firstname']) }}" method="post">
                    @csrf
                    <label for="firstname">Nieuwe voornaam</label>
                    <input type="text" id="firstname" name="firstname">
                    <button type="submit">Submit</button>
                    <button type="button" onclick="document.getElementById('changeVoornaamDialog').close()">Cancel</button>
                </form>                
            </dialog>

            <dialog id="changeEmailDialog">
                <form action="{{ route('updateCredentials', ['id' => 'email']) }}" method="post">
                    @csrf
                    <label for="email">Nieuwe email</label>
                    <input type="text" id="email" name="email">
                    <button type="submit">Submit</button>
                    <button type="button" onclick="document.getElementById('changeEmailDialog').close()">Cancel</button>
                </form>                 
            </dialog>

            <dialog id="changePhoneDialog">
                <form action="{{ route('updateCredentials', ['id' => 'phone']) }}" method="post">
                    @csrf
                    <label for="phone">Nieuw GSM nummer:</label>
                    <input type="text" id="phone" name="phone">
                    <button type="submit">Submit</button>
                    <button type="button" onclick="document.getElementById('changePhoneDialog').close()">Cancel</button>
                </form>                
            </dialog>

            <dialog id="changeStreetnrDialog">
                <form action="{{ route('updateCredentials', ['id' => 'streetnr']) }}" method="post">
                    @csrf
                    <label for="streetnr">Nieuwe straat + nr: </label>
                    <input type="text" id="streetnr" name="streetnr">
                    <button type="submit">Submit</button>
                    <button type="button" onclick="document.getElementById('changeStreetnrDialog').close()">Cancel</button>
                </form>                
            </dialog>

            <dialog id="changeCityDialog">
                <form action="{{ route('updateCredentials', ['id' => 'city']) }}" method="post">
                    @csrf
                    <label for="city">Nieuwe stad / gemeente: </label>
                    <input type="text" id="city" name="city">
                    <button type="submit">Submit</button>
                    <button type="button" onclick="document.getElementById('changeCityDialog').close()">Cancel</button>
                </form>                 
            </dialog>

            <dialog id="changePasswordDialog">
                <form action="{{ route('updateCredentials', ['id' => 'password']) }}" method="post">
                    @csrf
                    <label for="password">Nieuw paswoord: </label>
                    <input type="password" id="password" name="password"><br><br>

                    <label for="password">Bevestig paswoord: </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"><br><br>

                    <button type="submit">Submit</button>
                    <button type="button" onclick="document.getElementById('changePasswordDialog').close()">Cancel</button>
                </form>                 
            </dialog>
        </div>

    </div>    
</div>

@endsection
