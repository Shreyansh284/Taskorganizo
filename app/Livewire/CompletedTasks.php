<?php

namespace App\Livewire;

use App\Traits\TaskTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class CompletedTasks extends Component
{
    use TaskTrait;
    #[On('taskAdded')]
    public function mount()
    {
        $this->commonMount();
    }
    public function render()
    {
        $user = getUserByEmail(session()->get('email'));

        $tasks = getCompletedTasks($user->id);
        $updatedTasks = getUpdatedTasks($tasks);
        $updatedTasks = collect($updatedTasks);

        $updatedTasks = $this->getFilteredTasks($updatedTasks);
        getFormetedDuedate($updatedTasks);

        return view('livewire.completed-tasks', ['tasks' => $updatedTasks, 'user_id' => $user->id]);
    }
}
