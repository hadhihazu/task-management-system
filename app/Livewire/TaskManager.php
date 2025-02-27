<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use App\Models\TaskStatus;
use App\Models\TaskPriority;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class TaskManager extends Component
{
    use WithPagination;

    public $taskId, $title, $description, $due_date, $due_time, $status_id, $priority_id;
    public $isEditing = false;
    public $message = false;

    public function getUserId()
    {
        return Auth::id();
    }

    protected $rules = [
        'title' => 'required|min:3',
        'status_id' => 'required',
        'priority_id' => 'required',
    ];

    public function addTask()
    {
        $this->validate();

        Task::create([
            'user_id' => $this->getUserId(),
            'title' => $this->title,
            'description' => $this->description,
            'status_id' => $this->status_id,
            'priority_id' => $this->priority_id,
            'due_date' => $this->due_date,
            'due_time' => $this->due_time,
        ]);

        $this->message = true;
        $this->resetFields();
    }

    public function editTask($id)
    {
        $task = Task::findOrFail($id);
        $this->taskId = $task->id;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->status_id = $task->status_id;
        $this->priority_id = $task->priority_id;
        $this->due_date = $task->due_date;
        $this->due_time = $task->due_time;
        $this->isEditing = true;
    }

    public function updateTask()
    {
        $this->validate();

        if ($this->taskId) {
            $task = Task::findOrFail($this->taskId);
            $task->update([
                'title' => $this->title,
                'description' => $this->description,
                'status_id' => $this->status_id,
                'priority_id' => $this->priority_id,
                'due_date' => $this->due_date,
                'due_time' => $this->due_time,
            ]);

            $this->resetFields();
        }
    }

    public function deleteTask($id)
    {
        Task::findOrFail($id)->delete();
        $this->resetPage();
    }

    public function completeTask($id)
    {
        $task = Task::findOrFail($id); // Correctly use $id
        $task->update([
            'status_id' => 3, // Assuming 3 is the 'Completed' status
        ]);
    }

    private function resetFields()
    {
        $this->reset(['taskId', 'title', 'description', 'status_id', 'priority_id', 'due_date', 'due_time', 'isEditing']);
    }

    public function getTasks()
    {
        return Task::where('user_id', $this->getUserId())->latest()->paginate(5);
    }

    public function getStatuses()
    {
        return TaskStatus::all();
    }

    public function getPriorities()
    {
        return TaskPriority::all();
    }

    public function render()
    {
        return view('livewire.task-manager', [
            'tasks' => $this->getTasks(),
            'statuses' => $this->getStatuses(),
            'priorities' => $this->getPriorities(),
        ]);
    }
}
