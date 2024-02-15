<?php

namespace App\Livewire;

use App\Models\task;
use App\Traits\TaskEditDeleteTrait;
use Livewire\Component;

class CompletedTasks extends Component

{
    use TaskEditDeleteTrait;
    public $searchedTask = "";

    public function render()
    {
        $user = getUserByEmail(session()->get('email'));

        $tasks = getCompletedTasks($user->id);
        getFormetedDuedate($tasks);
        $updatedTasks=getUpdatedTasks($tasks);

        return view('livewire.completed-tasks')->with('tasks', $updatedTasks);
    }
}
