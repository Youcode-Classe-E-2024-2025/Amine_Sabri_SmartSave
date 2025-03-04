<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaveSmart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-blue-600">
        <div class="container">
            <a class="navbar-brand" href="{{ route('profiles.index') }}">SaveSmart</a>
            <ul class="navbar-nav flex items-center">
                @auth
                    <li class="nav-item px-2"><a class="nav-link text-white" href="{{ route('profiles.index') }}">Home</a></li>
                    <!-- <li class="nav-item px-2"><a class="nav-link text-white" ></a></li> -->
                    @if (session('current_profile') && (request()->routeIs('home') || request()->routeIs('profilePesronnel')))
                        <li class="nav-item px-2">
                            <a class="nav-link text-white" href="{{ route('profilePesronnel', session('current_profile')) }}">Profile personnel</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link text-white" href="{{ route('home', session('current_profile')) }}">Dashboard</a>
                        </li>
                    @endif
                    <!-- <li class="nav-item"><a class="nav-link" href="{{ route('profiles.index') }}">Profils</a></li> -->
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-white border-2 border-white p-1 rounded">{{ session("CompteName") }}<i class="bi bi-box-arrow-right ml-2"></i></button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Se connecter</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">S'inscrire</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
