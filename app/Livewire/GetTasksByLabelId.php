<?php

namespace App\Livewire;

use App\Traits\TaskTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class GetTasksByLabelId extends Component
{
    use TaskTrait;
    public $label_id;
    public function mount($label_id)
    {
        $this->commanMount();
        $this->label_id = $label_id;
    }
    public function render()
    {
        $user = getUserByEmail(session()->get('email'));

        $tasks = getTasksByLabelId($user->id, $this->label_id);
        $updatedTasks = getUpdatedTasks($tasks);
        $updatedTasks = collect($updatedTasks);

        $updatedTasks = $this->getFilteredTasks($updatedTasks);
        getFormetedDuedate($updatedTasks);

        return view('livewire.get-tasks-by-label-id')->with('tasks', $updatedTasks);
    }
}
