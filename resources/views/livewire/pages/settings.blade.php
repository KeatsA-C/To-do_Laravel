
    <div class="max-w-xl mx-auto space-y-8 mt-6">

        <h1 class="text-2xl font-bold">User Settings</h1>

        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded">
                {{ session('message') }}
            </div>
        @endif

        {{-- Profile Update Form --}}
<form wire:submit.prevent="updateProfile" class="space-y-4 bg-white p-6 rounded shadow relative">
    <h2 class="text-lg font-semibold mb-4">Update Profile</h2>

    {{-- Avatar Upload --}}
    <div class="relative w-24 h-24 mx-auto mb-4 group cursor-pointer" onclick="document.getElementById('photoUpload').click()">
        @if ($photo)
            <img src="{{ $photo->temporaryUrl() }}" class="w-24 h-24 rounded-full object-cover border-2 border-cyan-500">
        @elseif (auth()->user()->profile_photo_path)
            <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" class="w-24 h-24 rounded-full object-cover border-2 border-cyan-500">
        @else
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}" class="w-24 h-24 rounded-full object-cover border-2 border-cyan-500">
        @endif

        {{-- Hover Overlay --}}
        <div class="absolute inset-0 bg-black bg-opacity-50 rounded-full opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
            <span class="text-white text-sm">Change Photo</span>
        </div>

        <input type="file" id="photoUpload" wire:model="photo" class="hidden" accept="image/*">
        @error('photo') <p class="text-red-500 text-sm mt-1 text-center">{{ $message }}</p> @enderror
    </div>

    {{-- Name --}}
    <div>
        <label class="block font-medium">Name</label>
        <input type="text" wire:model.defer="name" class="w-full border rounded p-2">
        @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Email --}}
    <div>
        <label class="block font-medium">Email</label>
        <input type="email" wire:model.defer="email" class="w-full border rounded p-2">
        @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="bg-cyan-600 text-white px-4 py-2 rounded">Save</button>
</form>


        {{-- Password Update Form --}}
        <form wire:submit.prevent="updatePassword" class="space-y-4 bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold">Change Password</h2>

            <div>
                <label class="block font-medium">New Password</label>
                <input type="password" wire:model.defer="password" class="w-full border rounded p-2">
                @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Confirm Password</label>
                <input type="password" wire:model.defer="password_confirmation" class="w-full border rounded p-2">
            </div>

            <button type="submit" class="bg-cyan-600 text-white px-4 py-2 rounded">Change Password</button>
        </form>

    </div>
