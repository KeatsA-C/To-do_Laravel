{{-- resources/views/welcome.blade.php --}}
<x-layouts.app :hideHeader="true" :hideSidebar="true" :hideFooter="true">
	<div class="flex min-h-screen items-center justify-center bg-white">
		<div class="text-center">
			<h1 class="mb-4 text-4xl font-bold">Welcome to {{ config('app.name', 'To-Do App') }}</h1>

			@auth
				<p class="mb-4 text-lg">Hey {{ Auth::user()->name }}, you’re already logged in.</p>
				<a href="{{ route('dashboard') }}" class="text-cyan-600 underline">Go to Dashboard</a>
			@else
				<p class="mb-4 text-lg">Get started by logging in or registering below:</p>
				<div class="space-x-4">
					<a href="{{ route('login') }}" class="text-cyan-600 underline">Login</a>
					<a href="{{ route('register') }}" class="text-cyan-600 underline">Register</a>
				</div>
			@endauth

			<div class="mt-8 text-sm text-gray-500">
				Laravel v{{ Illuminate\Foundation\Application::VERSION }} / PHP v{{ PHP_VERSION }}
			</div>
		</div>
	</div>
</x-layouts.app>
