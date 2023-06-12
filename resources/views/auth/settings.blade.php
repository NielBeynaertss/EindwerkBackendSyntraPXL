@extends('auth.layouts')

@section('content')
<style>
    dialog{
        width: 700px;
    }
</style>

<div class="row justify-content-center mt-5">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <div class="row ">
                    <div class="col">
                        <p>User Information</p>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <button type="button" onclick="document.getElementById('changeCredentialsDialog').showModal()">Show info</button>
                    </div>
                </div>
                
            </div>
        </div>

        <dialog id="changeCredentialsDialog">


            <div class="row">
                <div class="col-3">
                    <p><b>Achternaam:</b></p>
                    <p><b>Voornaam:</b></p>
                    <p><b>Email adress</b></p>
                    <p><b>GSM</b></p>
                    <p><b>Straat + nummer</b></p>
                    <p><b>Stad / gemeente</b></p>
                    <p><b>Wachtwoord</b></p>
                </div>
                <div class="col">
                    <p>{{ Auth::guard('member')->user()->lastname}}</p>
                    <p>{{ Auth::guard('member')->user()->firstname}}</p>
                    <p>{{ Auth::guard('member')->user()->email}}</p>
                    <p>{{ Auth::guard('member')->user()->phone}}</p>
                    <p>{{ Auth::guard('member')->user()->streetnr}}</p>
                    <p>{{ Auth::guard('member')->user()->city}}</p>
                    <p>********</p>
                </div>
                <div class="col">
                    <p><a onclick="document.getElementById('changeCredentialsDialog').showModal()"><i class="fa-solid fa-pen-to-square"></i></a></p>
                    <p><a onclick="document.getElementById('changeCredentialsDialog').showModal()"><i class="fa-solid fa-pen-to-square"></i></a></p>
                    <p><a onclick="document.getElementById('changeCredentialsDialog').showModal()"><i class="fa-solid fa-pen-to-square"></i></a></p>
                    <p><a onclick="document.getElementById('changeCredentialsDialog').showModal()"><i class="fa-solid fa-pen-to-square"></i></a></p>
                    <p><a onclick="document.getElementById('changeCredentialsDialog').showModal()"><i class="fa-solid fa-pen-to-square"></i></a></p>
                    <p><a onclick="document.getElementById('changeCredentialsDialog').showModal()"><i class="fa-solid fa-pen-to-square"></i></a></p>
                    <p><a onclick="document.getElementById('changeCredentialsDialog').showModal()"><i class="fa-solid fa-pen-to-square"></i></a></p>
                </div>
            </div>

            <button type="button" onclick="document.getElementById('changeCredentialsDialog').close()">Cancel</button>

        </dialog>
    </div>    
</div>

@endsection
