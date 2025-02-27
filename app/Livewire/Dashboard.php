<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class Dashboard extends Component
{
    public function getCountsProperty()
    {
        return [
            'total' => Task::count(),
            'high_priority' => Task::where('priority_id', 1)->count(),
            'medium_priority' => Task::where('priority_id', 2)->count(),
            'low_priority' => Task::where('priority_id', 3)->count(),
            'pending' => Task::where('status_id', 1)->count(),
            'completed' => Task::where('status_id', 3)->count(),
            'in_progress' => Task::where('status_id', 2)->count(),
            'on_hold' => Task::where('status_id', 4)->count(),
        ];
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'counts' => $this->counts,
        ]);
    }
}
