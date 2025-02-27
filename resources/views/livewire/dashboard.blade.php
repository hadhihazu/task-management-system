<div class="container text-center">
    <div class="row mb-6 gap-6">
        <!-- Total -->
        <div class="col bg-primary text-white p-4 rounded-lg shadow">
            <p class="text-lg font-bold">Total</p>
            <p class="text-2xl">{{ $counts['total'] }}</p>
        </div>

        <!-- High Priority -->
        <div class="col bg-red-500 text-white p-4 rounded-lg shadow">
            <p class="text-lg font-bold">High Priority</p>
            <p class="text-2xl">{{ $counts['high_priority'] }}</p>
        </div>

        <!-- Medium Priority -->
        <div class="col bg-yellow-500 text-white p-4 rounded-lg shadow">
            <p class="text-lg font-bold">Medium Priority</p>
            <p class="text-2xl">{{ $counts['medium_priority'] }}</p>
        </div>

        <!-- Low Priority -->
        <div class="col bg-green-500 text-white p-4 rounded-lg shadow">
            <p class="text-lg font-bold">Low Priority</p>
            <p class="text-2xl">{{ $counts['low_priority'] }}</p>
        </div>
    </div>

    <div class="row gap-6">
        <!-- Pending Tasks -->
        <div class="col bg-blue-500 text-white p-4 rounded-lg shadow">
            <p class="text-lg font-bold">Pending</p>
            <p class="text-2xl">{{ $counts['pending'] }}</p>
        </div>

        <!-- Completed Tasks -->
        <div class="col bg-blue-500 text-white p-4 rounded-lg shadow">
            <p class="text-lg font-bold">Completed</p>
            <p class="text-2xl">{{ $counts['completed'] }}</p>
        </div>

        <!-- In Progress Tasks -->
        <div class="col bg-indigo-500 text-white p-4 rounded-lg shadow">
            <p class="text-lg font-bold">In Progress</p>
            <p class="text-2xl">{{ $counts['in_progress'] }}</p>
        </div>

        <!-- On Hold Tasks -->
        <div class="col bg-gray-500 text-white p-4 rounded-lg shadow">
            <p class="text-lg font-bold">On Hold</p>
            <p class="text-2xl">{{ $counts['on_hold'] }}</p>
        </div>
    </div>
    <div class="row mt-6 justify-end flex min-w-full">
        <a href="{{ route('task-manager') }}" class="btn btn-primary">Manage Task</a>
    </div>
</div>
