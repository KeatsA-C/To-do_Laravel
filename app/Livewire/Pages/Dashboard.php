<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Task;

class Dashboard extends Component
{
    public function render()
    {
        $tasks = Task::where('user_id', auth()->id())->get();

        return view('livewire.pages.dashboard', [
            'tasks' => $tasks,
        ]);
    }
}
