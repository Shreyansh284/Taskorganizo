<?php
namespace App\Livewire;


use App\Models\label;
use App\Models\project;
use App\Models\task;
use App\Traits\TaskTrait;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use stdClass;
use App\CustomModels\TaskData;


class Inbox extends Component
{

    use TaskTrait;

    #[On('taskAdded')]
    public function render()
    {
        $user = getUserByEmail(session()->get('email'));

        $tasks = getNotCompletedTasks($user->id);

        $updatedTasks=getUpdatedTasks($tasks);

        $updatedTasks=$this->getFilteredTasks($updatedTasks);
        getFormetedDuedate(collect($updatedTasks));

        return view('livewire.inbox', ['tasks' => $updatedTasks]);
    }


}
