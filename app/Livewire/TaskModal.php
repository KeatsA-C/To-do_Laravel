<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskModal extends Component
{
    // Livewire listeners
    protected $listeners = [
        'open-task-modal' => 'openModal',
        'edit-task' => 'loadTask',
    ];

    // Public properties (form fields & modal state)
    public $taskId = null;

    public $showModal = false;

    public $title = '';

    public $description = '';

    public $due_date = '';

    /**
     * Open modal for creating a new task.
     */
    public function openModal()
    {
        $this->reset(['taskId', 'title', 'description', 'due_date']);
        $this->showModal = true;
    }

    /**
     * Open modal with existing task data for editing.
     */
    public function loadTask($id)
    {
        $task = Task::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $this->taskId = $task->id;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->due_date = optional($task->due_date)->format('Y-m-d');

        $this->showModal = true;
    }

    /**
     * Close modal and reset state.
     */
    public function closeModal()
    {
        $this->showModal = false;
    }

    /**
     * Save or update a task.
     */
    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        if ($this->taskId) {
            // Update existing task
            Task::where('id', $this->taskId)
                ->where('user_id', auth()->id())
                ->update([
                    'title' => $this->title,
                    'description' => $this->description,
                    'due_date' => $this->due_date,
                ]);
        } else {
            // Create new task
            Task::create([
                'user_id' => auth()->id(),
                'title' => $this->title,
                'description' => $this->description,
                'due_date' => $this->due_date,
            ]);
        }

        $this->dispatch('task-created');
        $this->closeModal();
    }

    /**
     * Render the modal view.
     */
    public function render()
    {
        return view('livewire.task-modal');
    }
}
