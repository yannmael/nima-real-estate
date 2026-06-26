<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') — NIMA</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col">

    @if(auth()->check() && auth()->user()->is_admin)
    <nav class="bg-primary-800 text-white px-6 py-3 flex items-center justify-between">
        <span class="font-bold text-sm tracking-wide">NIMA — Administration</span>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit"
                    class="text-xs text-white/70 hover:text-white transition-colors">
                Déconnexion
            </button>
        </form>
    </nav>
    @endif

    <main class="flex-1 flex items-center justify-center p-6">
        @yield('content')
    </main>

</body>
</html>
