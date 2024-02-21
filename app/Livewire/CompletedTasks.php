<?php

namespace App\Livewire;

use App\Traits\TaskTrait;
use Livewire\Component;

class CompletedTasks extends Component
{
    use TaskTrait;
    
    public function render()
    {
        $user = getUserByEmail(session()->get('email'));

        $tasks = getCompletedTasks($user->id);

        $updatedTasks=getUpdatedTasks($tasks);
        getFormetedDuedate(collect($updatedTasks));

        $updatedTasks=$this->getFilteredTasks($updatedTasks);

        return view('livewire.completed-tasks', ['tasks' => $updatedTasks]);

    }
}
