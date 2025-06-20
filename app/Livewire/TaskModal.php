<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskModal extends Component
{
    protected $listeners = ['open-task-modal' => 'openModal'];

    public $showModal = false;

    public $title;

    public $description;

    public $due_date;

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
