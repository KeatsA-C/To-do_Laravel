<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'To-Do App') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body x-data="{ sidebarOpen: true }" class="bg-gray-100 text-gray-900">
    <div class="flex flex-col min-h-screen overflow-hidden">

        {{-- Header --}}
        <header class="bg-cyan-600 text-white shadow fixed top-0 left-0 right-0 z-20 h-16 flex items-center">
            <div class="flex items-center justify-between w-full px-4">
                <div class="flex items-center gap-4">
                    {{-- Burger Button --}}
                    <button @click="sidebarOpen = !sidebarOpen" class="text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <span class="text-xl font-bold">📅 To-Do App</span>
                </div>

                {{-- User Info --}}
                @auth
                    <div class="flex items-center gap-2">
                        <img
                            src="{{ Auth::user()->profile_photo_path
                                ? asset('storage/' . Auth::user()->profile_photo_path)
                                : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                            class="w-8 h-8 rounded-full"
                            alt="Avatar">
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
        <div class="flex flex-1 pt-16">
            {{-- Sidebar --}}
            <aside
                x-show="sidebarOpen"
                x-transition:enter="transition duration-200 ease-out"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition duration-150 ease-in"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                class="w-60 bg-white shadow z-10 flex-shrink-0"
                x-cloak
                style="height: calc(100vh - 4rem);"
            >
                <nav class="p-4 space-y-2">
                    <a href="{{ route('dashboard') }}" class="block py-2 px-3 rounded hover:bg-cyan-100">Dashboard</a>
                    <a href="{{ route('calendar') }}" class="block py-2 px-3 rounded hover:bg-cyan-100">Calendar</a>
                    <a href="{{ route('settings') }}" class="block py-2 px-3 rounded hover:bg-cyan-100">Settings</a>

                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left py-2 px-3 rounded hover:bg-cyan-100">Logout</button>
                        </form>
                    @endauth

                </nav>
            </aside>

            {{-- Page Content --}}
            <main class="flex-1 p-6 overflow-auto bg-gray-50">
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
