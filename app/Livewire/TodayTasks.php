<?php

namespace App\Livewire;

use App\Models\label;
use App\Models\project;
use App\Models\task;
use App\Traits\TaskEditDeleteTrait;
use Illuminate\Support\Carbon;

use Livewire\Attributes\On;
use Livewire\Component;

class TodayTasks extends Component
{
    use TaskEditDeleteTrait;
    public $searchedTasks;

    #[On('taskAdded')]
    public function render()
    {

        $user = getUserByEmail(session()->get('email'));
        $todayTasks =getTasksWhereDueDateIsToday($user->id);
        getFormetedDuedate($todayTasks);
        $updatedTasks=getUpdatedTasks($todayTasks);
        if ($this->searchedTasks) {
            $updatedTasks = $this->filterByTaskName(collect($updatedTasks));
        }
        $date = todaydate();

        return view('livewire.today-tasks', ['todayTasks' => $updatedTasks], ['date' => $date]);
    }
    function filterByTaskName($tasks)
    {
        return $tasks->filter(function ($task) {
            return stripos($task->task_name, $this->searchedTasks) !== false;
        });
    }

}
