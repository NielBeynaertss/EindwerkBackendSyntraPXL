@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">Registreren</div>
            <div class="card-body">
                <form action="{{ route('storeNewMember') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="lastname" class="col-md-4 col-form-label text-md-end text-start">Achternaam: </label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ old('lastname') }}">
                            @if ($errors->has('lastname'))
                                <span class="text-danger">{{ $errors->first('lastname') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="firstname" class="col-md-4 col-form-label text-md-end text-start">Voornaam: </label>
                        <div class="col-md-6">
                          <input type="firstname" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname">
                            @if ($errors->has('firstname'))
                                <span class="text-danger">{{ $errors->first('firstname') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email: </label>
                        <div class="col-md-6">
                          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="phone" class="col-md-4 col-form-label text-md-end text-start">GSM: </label>
                        <div class="col-md-6">
                          <input type="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone">
                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="streetnr" class="col-md-4 col-form-label text-md-end text-start">Straat + nummer: </label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('streetnr') is-invalid @enderror" id="streetnr" name="streetnr">
                            @if ($errors->has('streetnr'))
                                <span class="text-danger">{{ $errors->first('streetnr') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="city" class="col-md-4 col-form-label text-md-end text-start">Stad / gemeente: </label>
                        <div class="col-md-6">
                          <input type="city" class="form-control @error('city') is-invalid @enderror" id="city" name="city">
                            @if ($errors->has('city'))
                                <span class="text-danger">{{ $errors->first('city') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="postalcode" class="col-md-4 col-form-label text-md-end text-start">Postcode: </label>
                        <div class="col-md-6">
                          <input type="number" pattern="{4}"class="form-control @error('postalcode') is-invalid @enderror" id="postalcode" name="postalcode">
                            @if ($errors->has('postalcode'))
                                <span class="text-danger">{{ $errors->first('postalcode') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="youthorganisation" class="col-md-4 col-form-label text-md-end text-start">Jeugdbeweging: </label>
                        <div class="col-md-6">
                            <select class="form-control @error('youthorganisation') is-invalid @enderror" id="youthorganisation" name="youthorganisation">
                                <option value="">Kies jeugdbeweging</option>
                                @foreach ($youthorganisations as $organisation)
                                    <option value="{{ $organisation->id }}">{{ $organisation->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('youthorganisation'))
                                <span class="text-danger">{{ $errors->first('youthorganisation') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-md-4 col-form-label text-md-end text-start">Wachtwoord: </label>
                        <div class="col-md-6">
                          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start">Bevestig wachtwoord: </label>
                        <div class="col-md-6">
                          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Registreren">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection