<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'To-Do App') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100 text-gray-900">
    <div class="flex flex-col min-h-screen">

        {{-- Header --}}
        <header class="bg-cyan-600 text-white shadow fixed top-0 w-full z-10">
            <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
                <div class="text-xl font-bold">📅 To-Do App</div>
                @auth
                    <div class="flex items-center gap-2">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="Avatar" class="w-8 h-8 rounded-full">
                        <span>{{ Auth::user()->name }}</span>
                    </div>
                @else
                    <div class="space-x-2">
                        <a href="{{ route('login') }}" class="hover:underline">Login</a>
                        <a href="{{ route('register') }}" class="hover:underline">Register</a>
                    </div>
                @endauth
            </div>
        </header>

        {{-- Sidebar + Content --}}
        <div class="flex pt-16 flex-1">
            <aside class="w-60 bg-white shadow h-full hidden md:block">
                <nav class="p-4 space-y-2">
                    <a href="{{ route('dashboard') }}" class="block py-2 px-3 rounded hover:bg-cyan-100">Dashboard</a>
                    <a href="#" class="block py-2 px-3 rounded hover:bg-cyan-100">Calendar</a>
                    <a href="#" class="block py-2 px-3 rounded hover:bg-cyan-100">Settings</a>
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left py-2 px-3 rounded hover:bg-cyan-100">Logout</button>
                        </form>
                    @endauth
                </nav>
            </aside>

            <main class="flex-1 p-6 bg-gray-50">
                {{ $slot }}
            </main>
        </div>

        {{-- Footer --}}
        <footer class="bg-white border-t py-4 text-center text-sm text-gray-500">
            © {{ now()->year }} To-Do App. Built with Laravel & Livewire.
        </footer>
    </div>

    @livewireScripts
</body>
</html>

