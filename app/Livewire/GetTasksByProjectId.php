<?php

namespace App\Livewire;

use App\Models\task;
use App\Traits\TaskTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class GetTasksByProjectId extends Component
{
    use TaskTrait;
    public $project_id;
    public function mount($project_id)
    {
        $this->commanMount();
        $this->project_id = $project_id;
    }
    public function render()
    {
        $user = getUserByEmail(session()->get('email'));

        $tasks = getTasksByProjectId($user->id, $this->project_id);
        $updatedTasks = getUpdatedTasks($tasks);
        $updatedTasks = collect($updatedTasks);

        $updatedTasks = $this->getFilteredTasks($updatedTasks);
        getFormetedDuedate($updatedTasks);

        return view('livewire.get-tasks-by-project-id')->with('tasks', $updatedTasks);
    }
}
