<?php

namespace App\Livewire;

use App\Traits\TaskTrait;
use Livewire\Component;

class TodayTasks extends Component
{
    use TaskTrait;
    public function render()
    {
        $user = getUserByEmail(session()->get('email'));

        $tasks = getTasksWhereDueDateIsToday($user->id);

        $updatedTasks=getUpdatedTasks($tasks);
        getFormetedDuedate(collect($updatedTasks));

        $updatedTasks=$this->getFilteredTasks($updatedTasks);

        return view('livewire.today-tasks', ['tasks' => $updatedTasks]);
    }
}
