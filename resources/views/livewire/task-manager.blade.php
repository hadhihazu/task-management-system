<div>
    <!-- Success Message -->
    @if ($message == true)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Add/Edit Task Form -->
    <form wire:submit.prevent="{{ $isEditing ? 'updateTask' : 'addTask' }}" class="mb-4">
        <input type="text" wire:model="title" placeholder="Task Title" class="border rounded px-2 py-1 w-full mb-2">
        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <textarea wire:model="description" placeholder="Task Description" class="border rounded px-2 py-1 w-full mb-2"></textarea>
        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <select wire:model="status_id" class="border rounded px-2 py-1 w-full mb-2">
            <option value="">Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->name }}</option>
            @endforeach
        </select>
        @error('status_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <select wire:model="priority_id" class="border rounded px-2 py-1 w-full mb-2">
            <option value="">Select Priority</option>
            @foreach($priorities as $priority)
                <option value="{{ $priority->id }}">{{ $priority->name }}</option>
            @endforeach
        </select>
        @error('priority_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <input type="date" wire:model="due_date" class="border rounded px-2 py-1 w-full mb-2">
        @error('due_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <input type="time" wire:model="due_time" class="border rounded px-2 py-1 w-full mb-2">
        @error('due_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            {{ $isEditing ? 'Update Task' : 'Add Task' }}
        </button>

        @if($isEditing)
            <button type="button" wire:click="resetFields" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>
        @endif
    </form>

    <!-- Task List -->
    <ul>
        @foreach($tasks as $task)
            <li class="flex justify-between items-center border-b py-2">
                <div>
                    <p class="font-semibold">{{ $task->title }}</p>
                    <p class="text-sm text-gray-500">{{ $task->description }}</p>
                    <p class="text-sm">Status: {{ $task->status->name }}</p>
                    <p class="text-sm">Priority: {{ $task->priority->name }}</p>
                    <p class="text-sm">Due Date: {{ $task->due_date ?? 'No deadline' }}</p>
                    <p class="text-sm">Due Time: {{ $task->due_time ?? 'No deadline' }}</p>
                </div>
                <div>
                    <button wire:click="completeTask({{ $task->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Complete</button>
                    <button wire:click="editTask({{ $task->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                    <button wire:click="deleteTask({{ $task->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                </div>
            </li>
        @endforeach
    </ul>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $tasks->links() }}
    </div>

    <script>
        setTimeout(() => {
            let alert = document.querySelector(".alert");
            if (alert) {
                alert.classList.remove("show");
                alert.classList.add("fade");
            }
        }, 3000); // Hide after 3 seconds
    </script>
</div>
