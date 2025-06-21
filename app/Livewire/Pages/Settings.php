<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $photo;

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'photo' => 'nullable|image|max:1024', // 1MB max
        ]);

        $user = auth()->user();

        if ($this->photo) {
            $path = $this->photo->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'profile_photo_path' => $user->profile_photo_path ?? null,
        ]);

        $this->dispatch('profile-updated', photo: asset('storage/' . $user->profile_photo_path), name: $user->name);

        session()->flash('message', 'Profile updated successfully.');
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        Auth::user()->update([
            'password' => Hash::make($this->password),
        ]);

        $this->reset('password', 'password_confirmation');
        session()->flash('message', 'Password updated successfully.');
    }

    public function render()
    {
        return view('livewire.pages.settings');
    }
}
