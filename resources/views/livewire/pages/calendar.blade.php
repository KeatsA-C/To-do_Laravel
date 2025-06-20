<div class="space-y-6">
    {{-- Calendar Navigation --}}
    <div class="mb-4 flex justify-between items-center">
        <button wire:click="previousMonth" class="text-cyan-600 hover:underline">← Previous</button>
        <h1 class="text-xl font-bold">{{ $monthName }} {{ $year }}</h1>
        <button wire:click="nextMonth" class="text-cyan-600 hover:underline">Next →</button>
    </div>

    {{-- Weekday Headers --}}
    <div class="grid grid-cols-7 gap-2 text-center font-semibold text-gray-600">
        @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
            <div>{{ $day }}</div>
        @endforeach
    </div>

    {{-- Calendar Grid (Already includes gray days in $days) --}}
    <div class="grid grid-cols-7 gap-2 text-sm">
        @foreach($days as $day)
            <div wire:click="selectDate('{{ $day['date']->toDateString() }}')"
                 class="{{ $day['isCurrentMonth'] ? 'bg-white' : 'bg-gray-100 text-gray-400' }} p-2 rounded-lg shadow cursor-pointer hover:bg-cyan-100 transition-all duration-150">
                <div class="text-xs font-bold">{{ $day['date']->day }}</div>
                <div class="mt-1 space-y-1">
                    @foreach($day['tasks'] as $task)
                        <div class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded text-xs truncate">
                            {{ $task->title }}
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    {{-- Add Task Modal --}}
    @livewire('task-modal')
</div>
