<div>
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    @if ($selectedDate)
    <div class="mb-4 flex items-center justify-between bg-cyan-100 border-l-4 border-cyan-400 text-cyan-800 p-3 rounded">
        <span>Showing tasks for <strong>{{ \Carbon\Carbon::parse($selectedDate)->toFormattedDateString() }}</strong></span>
    </div>
@endif


    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($tasks as $task)
        
            <div class="bg-cyan-50 border-l-4 border-cyan-500 text-cyan-900 rounded-xl shadow p-4 {{ $task->completed ? 'opacity-50 line-through' : '' }}">
                <h2 class="font-bold text-lg">{{ $task->title }}</h2>
                
                @if ($task->description)
                    <p class="text-sm mt-1">{{ $task->description }}</p>
                @endif

                @if ($task->due_date)
                    <p class="text-sm mt-2">Due: {{ \Carbon\Carbon::parse($task->due_date)->toFormattedDateString() }}</p>
                @endif

                <div class="mt-3 flex items-center gap-3 text-sm">
                    <button wire:click="toggleCompleted({{ $task->id }})" class="text-green-600 hover:underline">
                        {{ $task->completed ? 'Mark as Incomplete' : 'Mark as Completed' }}
                    </button>

                    <button wire:click="editTask({{ $task->id }})" class="text-blue-600 hover:underline">Edit</button>

                    <button wire:click="deleteTask({{ $task->id }})" class="text-red-600 hover:underline">Delete</button>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No tasks to show.</p>
        @endforelse

        @livewire('task-modal')
    </div>
</div>
