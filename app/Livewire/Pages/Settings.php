<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Settings extends Component
{
    public $name;

    public $email;

    public $password;

    public $password_confirmation;

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.Auth::id(),
        ]);

        Auth::user()->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

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
