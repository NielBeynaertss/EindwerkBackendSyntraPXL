<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>YouthLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('head')
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ URL('/') }}">YouthLink</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    @if (Auth::check())
                        <!-- Authenticated navbar links -->
                        <li class="nav-item"><a class="nav-link" href="{{ URL('/') }}"><i class="fa-solid fa-house"></i></i>  Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('marketplace') }}"><i class="fa-solid fa-magnifying-glass"></i>  Marktplaats</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('events') }}"><i class="fa-regular fa-calendar-days"></i>  Evenementen</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('forum') }}"> <i class="fa-solid fa-users"></i>  Forum</a></li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->firstname }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fa-solid fa-user"></i> Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('settings') }}"><i class="fa-solid fa-gear"></i> Instellingen</a></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"
                                    ><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <!-- Guest navbar links -->
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('register')) ? 'active' : '' }}" href="{{ route('register') }}">Registreren</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>    

    <div class="container">
        @yield('content')
    </div>
       
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>    
</body>
</html>
