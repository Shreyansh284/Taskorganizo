<?php

namespace App\Livewire;

use App\Models\project;
use App\Models\task;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
class TasksByProject extends Component
{

    public $project_name;

    public function mount()
    {
        // Retrieve the project ID from the route parameters
        $this->project_name = Route::current()->parameter('project_name');
    }

    public function render()
    {
        // Fetch tasks based on $this->projectId
        $project=project::where('project_name',$this->project_name)->first();
        $tasks = task::where('project_id', $project->id)->get();

        return view('livewire.tasks-by-project')->with('tasks',$tasks);
    }
}
