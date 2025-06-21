<?php

namespace App\Livewire\Pages;

use App\Models\Task;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public $selectedDate = null;

    protected $listeners = [
        'task-created' => '$refresh',
    ];

    public function mount()
    {
        // Still allow filtering by date via URL
        $this->selectedDate = request()->query('date');
    }

    public function render()
    {
        $query = Task::where('user_id', auth()->id());

        if ($this->selectedDate) {
            $query->whereDate('due_date', $this->selectedDate);
        }

        return view('livewire.pages.dashboard', [
            'tasks' => $query->latest()->get(),
            'selectedDate' => $this->selectedDate,
        ]);
    }

    public function toggleCompleted($taskId)
    {
        $task = Task::where('id', $taskId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $task->completed = ! $task->completed;
        $task->save();
    }

    public function deleteTask($taskId)
    {
        Task::where('id', $taskId)
            ->where('user_id', auth()->id())
            ->delete();
    }

    public function editTask($id)
    {
        $this->dispatch('edit-task', id: $id)->to('task-modal');
    }
}
