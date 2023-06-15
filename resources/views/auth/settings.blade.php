@extends('auth.layouts')

@section('content')
<style>
    dialog{
        width: 700px;
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
            @if (Auth::guard('member')->user()->profile_picture)
                <button type="button" onclick="document.getElementById('profilePictureDialog').showModal()" class="profile_button">
                    <img src="{{ asset('profile-images/' . Auth::guard('member')->user()->profile_picture) }}" alt="Profile Picture" height="400px;">
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
                            <p>{{ Auth::guard('member')->user()->lastname}}</p>
                        </div>
                        <div class="col">
                            <p><a onclick="document.getElementById('changeCredentialsDialog').showModal()"><i class="fa-solid fa-pen-to-square"></i></a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p><b>Voornaam:</b></p>
                        </div>
                        <div class="col">
                            <p>{{ Auth::guard('member')->user()->firstname}}</p>
                        </div>
                        <div class="col">
                            <p><a onclick="document.getElementById('changeCredentialsDialog').showModal()"><i class="fa-solid fa-pen-to-square"></i></a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p><b>Email adress</b></p>
                        </div>
                        <div class="col">
                            <p>{{ Auth::guard('member')->user()->email}}</p>
                        </div>
                        <div class="col">
                            <p><a onclick="document.getElementById('changeCredentialsDialog').showModal()"><i class="fa-solid fa-pen-to-square"></i></a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p><b>GSM</b></p>
                        </div>
                        <div class="col">
                            <p>{{ Auth::guard('member')->user()->phone}}</p>
                        </div>
                        <div class="col">
                            <p><a onclick="document.getElementById('changeCredentialsDialog').showModal()"><i class="fa-solid fa-pen-to-square"></i></a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p><b>Straat + nummer</b></p>
                        </div>
                        <div class="col">
                            <p>{{ Auth::guard('member')->user()->streetnr}}</p>
                        </div>
                        <div class="col">
                            <p><a onclick="document.getElementById('changeCredentialsDialog').showModal()"><i class="fa-solid fa-pen-to-square"></i></a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <p><b>Stad / gemeente</b></p>
                        </div>
                        <div class="col">
                            <p>{{ Auth::guard('member')->user()->city}}</p>
                        </div>
                        <div class="col">
                            <p><a onclick="document.getElementById('changeCredentialsDialog').showModal()"><i class="fa-solid fa-pen-to-square"></i></a></p>
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
                            <p><a onclick="document.getElementById('changeCredentialsDialog').showModal()"><i class="fa-solid fa-pen-to-square"></i></a></p>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" onclick="document.getElementById('changeCredentialsDialog').close()">Cancel</button>

        </dialog>

    </div>    
</div>

@endsection
