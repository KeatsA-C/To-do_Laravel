{{-- uses layouts.app automatically because of config --}}

<div>
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($tasks as $task)
            <div class="bg-white rounded-xl shadow p-4 border-l-4 border-cyan-500">
                <h2 class="font-bold text-lg text-cyan-700">{{ $task->title }}</h2>
                @if ($task->description)
                    <p class="text-sm mt-1 text-gray-600">{{ $task->description }}</p>
                @endif
                @if ($task->due_date)
                    <p class="text-sm mt-2 text-gray-500">Due: {{ \Carbon\Carbon::parse($task->due_date)->toFormattedDateString() }}</p>
                @endif
            </div>
        @endforeach
        @livewire('task-modal')

    </div>
</div>
