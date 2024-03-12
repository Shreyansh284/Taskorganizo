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
        $this->commonMount();
        $this->project_id = $project_id;
    }
    #[On('taskAdded')]
    public function render()
    {
        $user = getUserByEmail(session()->get('email'));
        $project = getProjectByProjectId($this->project_id);
        $tasks = getTasksByProjectId($user->id, $this->project_id);
        $updatedTasks = getUpdatedTasks($tasks);
        $updatedTasks = collect($updatedTasks);

        $updatedTasks = $this->getFilteredTasks($updatedTasks);
        getFormetedDuedate($updatedTasks);

        return view('livewire.get-tasks-by-project-id', ['tasks' => $updatedTasks, 'user_id' => $user->id, 'project' => $project]);
    }
}
