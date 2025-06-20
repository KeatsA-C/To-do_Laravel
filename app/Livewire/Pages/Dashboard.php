<?php

namespace App\Livewire\Pages;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] // ✅ Add this line
class Dashboard extends Component
{
    protected $listeners = ['task-created' => '$refresh'];

    public function render()
    {
        $tasks = Task::where('user_id', auth()->id())->latest()->get();

        return view('livewire.pages.dashboard', [
            'tasks' => $tasks,
        ]);
    }
}
