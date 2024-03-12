<?php

namespace App\Livewire;

use Livewire\Component;

class Statistics extends Component
{
    public $incompleteTasks;
    public $completedTasks;
    public $teamTasks;

    public function mount()
    {
        $user = getUserByEmail(session()->get('email')); // Assuming you are using Laravel's built-in authentication
        $this->incompleteTasks = getNotCompletedTasks($user->id);
        $this->completedTasks = getCompletedTasks($user->id);
        $this->teamTasks = getTaskWhereTeamIdNotNull($user->id);
    }

    public function render()
    {
        return view('livewire.statistics');
    }
}
