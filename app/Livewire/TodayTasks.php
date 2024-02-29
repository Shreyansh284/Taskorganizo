<?php

namespace App\Livewire;

use App\Traits\TaskTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class TodayTasks extends Component
{
    use TaskTrait;
    #[On('taskAdded')]
    public function mount()
    {
        $this->commanMount();
    }
    public function render()
    {
        $user = getUserByEmail(session()->get('email'));

        $tasks = getTasksWhereDueDateIsToday($user->id);
        $updatedTasks = getUpdatedTasks($tasks);
        $updatedTasks = collect($updatedTasks);
        $updatedTasks = $this->getFilteredTasks($updatedTasks);
        getFormetedDuedate($updatedTasks);

        return view('livewire.today-tasks', ['tasks' => $updatedTasks]);
    }
}
