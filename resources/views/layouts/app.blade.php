<body x-data="{ sidebarOpen: true }" class="bg-gray-100 text-gray-900">
	<div class="flex min-h-screen flex-col overflow-hidden">

		{{-- Header --}}
		@if (!isset($hideHeader))
			<header class="fixed left-0 right-0 top-0 z-20 flex h-16 items-center bg-cyan-600 text-white shadow">
				<div class="flex w-full items-center justify-between px-4">
					<div class="flex items-center gap-4">
						{{-- Burger Button --}}
						<button @click="sidebarOpen = !sidebarOpen" class="text-white">
							<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
							</svg>
						</button>
						<span class="text-xl font-bold">📅 To-Do App</span>
					</div>

					@auth
						<div class="flex items-center gap-2">
							<img
								src="{{ Auth::user()->profile_photo_path
								    ? asset('storage/' . Auth::user()->profile_photo_path)
								    : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
								class="h-8 w-8 rounded-full" alt="Avatar">
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
		@endif

		{{-- Sidebar + Content --}}
		<div class="@if (!isset($hideHeader)) pt-16 @endif flex flex-1">
			{{-- Sidebar --}}
			@if (!isset($hideSidebar))
				<aside x-show="sidebarOpen" x-transition:enter="transition duration-200 ease-out"
					x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
					x-transition:leave="transition duration-150 ease-in" x-transition:leave-start="translate-x-0"
					x-transition:leave-end="-translate-x-full" class="z-10 w-60 flex-shrink-0 bg-white shadow" x-cloak
					style="height: calc(100vh - 4rem);">
					<nav class="space-y-2 p-4">
						<a href="{{ route('dashboard') }}" class="block rounded px-3 py-2 hover:bg-cyan-100">Dashboard</a>
						<a href="{{ route('calendar') }}" class="block rounded px-3 py-2 hover:bg-cyan-100">Calendar</a>
						<a href="{{ route('settings') }}" class="block rounded px-3 py-2 hover:bg-cyan-100">Settings</a>

						@auth
							<form method="POST" action="{{ route('logout') }}">
								@csrf
								<button class="w-full rounded px-3 py-2 text-left hover:bg-cyan-100">Logout</button>
							</form>
						@endauth
					</nav>
				</aside>
			@endif

			{{-- Page Content --}}
			<main class="flex-1 overflow-auto bg-gray-50 p-6">
				{{ $slot }}
			</main>
		</div>

		{{-- Footer --}}
		@unless (isset($hideFooter))
			<footer class="border-t bg-white py-4 text-center text-sm text-gray-500">
				© {{ now()->year }} To-Do App. Built with Laravel & Livewire.
			</footer>
		@endunless
	</div>

	@livewireScripts
</body>
