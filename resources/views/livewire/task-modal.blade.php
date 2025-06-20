<div>
    <!-- Add Task Button -->
    <button wire:click="openModal"
        class="fixed bottom-6 right-6 bg-cyan-600 text-white px-4 py-2 rounded-full shadow hover:bg-cyan-700 z-50">
        ➕ Add Task
    </button>

    <!-- Modal Overlay -->
    @if ($showModal)
        <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-40">
            <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md relative">
                <h2 class="text-xl font-semibold mb-4">Create New Task</h2>

                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium">Title</label>
                        <input type="text" wire:model="title" class="w-full border rounded p-2" required>
                        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium">Description</label>
                        <textarea wire:model="description" class="w-full border rounded p-2"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium">Due Date</label>
                        <input type="date" wire:model="due_date" class="w-full border rounded p-2">
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" wire:click="closeModal" class="text-gray-600 hover:underline">Cancel</button>
                        <button type="submit" class="bg-cyan-600 text-white px-4 py-2 rounded hover:bg-cyan-700">
                            Save Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
