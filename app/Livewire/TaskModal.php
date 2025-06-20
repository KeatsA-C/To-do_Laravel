<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskModal extends Component
{
    public $showModal = false;
    public $title, $description, $due_date;

    public function openModal()
    {
        $this->reset(['title', 'description', 'due_date']);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        Task::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
        ]);

        $this->dispatch('task-created'); // Notify dashboard to refresh
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.task-modal');
    }
}
