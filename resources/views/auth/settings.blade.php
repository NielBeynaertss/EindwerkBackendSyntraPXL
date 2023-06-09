@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">Settings</div>
            <div class="card-body">
                
                <h4>User Information:</h4>
                <p>{{ Auth::guard('member')->user()->lastname}}</p>
                <p>{{ Auth::guard('member')->user()->firstname}}</p>
                <p>{{ Auth::guard('member')->user()->email}}</p>
                <p>{{ Auth::guard('member')->user()->phone}}</p>
                <p>{{ Auth::guard('member')->user()->Streetnr}}</p>
                <p>{{ Auth::guard('member')->user()->city}}</p>

            </div>
        </div>
    </div>    
</div>

@endsection
