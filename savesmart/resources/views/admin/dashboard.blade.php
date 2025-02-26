<h2>Bienvenue, {{ Auth::user()->name }}</h2>
<p>Votre rôle : {{ Auth::user()->role }}</p>

@if(Auth::user()->role == 'admin')
    <a href="{{ route('admin.dashboard') }}">Accéder au Dashboard Admin</a>
@endif

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Déconnexion</button>
</form>
