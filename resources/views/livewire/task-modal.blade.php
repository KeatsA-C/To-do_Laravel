<div>
    <!-- Add Task Button -->
    <button wire:click="openModal"
        class="fixed bottom-6 right-6 bg-cyan-600 text-white px-4 py-2 rounded-full shadow hover:bg-cyan-700 z-50">
        ➕ Add Task
    </button>

    <!-- Modal Overlay -->
@if ($showModal)
<div class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow max-w-md w-full">
        <h2 class="text-lg font-bold mb-4">Add Task</h2>

        <form wire:submit.prevent="save" class="space-y-4">
            <div>
                <label class="block text-sm font-medium">Title</label>
                <input type="text" wire:model="title" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Description</label>
                <textarea wire:model="description" class="w-full border rounded p-2"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Due Date</label>
                <input type="date" wire:model="due_date" class="w-full border rounded p-2">
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" wire:click="closeModal" class="text-gray-500">Cancel</button>
                <button type="submit" class="bg-cyan-600 text-white px-4 py-2 rounded">Save</button>
            </div>
        </form>
    </div>
</div>
@endif

</div>
