<?php
namespace App\Traits;
use App\Models\label;
use App\Models\project;
use App\Models\task;
use App\Models\team;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

trait TaskTrait
{

    public $startDate;
    public $endDate;
    public $edit_task_id;
    public $edit_task_name = "";
    public $edit_task_description;
    public $edit_due_date;
    public $edit_priority;
    public $edit_projectId;
    public $edit_labelId;
    public $edit_teamId;

    public $searchedTasks = "";
    public $priorityFilter = "";
    public $labelFilter = "";
    public $dueDateFilter = "";
    public $projectFilter = "";
    public $projects = [];
    public $labels = [];
    public $teams = [];
    public function loadProjects()
    {
        $user = getUserByEmail(session()->get('email'));
        $this->projects = project::where('user_id', $user->id)->pluck('project_name', 'id')->toArray();
    }
    public function loadLabels()
    {
        $user = getUserByEmail(session()->get('email'));
        $this->labels = label::where('user_id', $user->id)->pluck('label_name', 'id')->toArray();
    }
    public function loadTeams()
    {
        $user = getUserByEmail(session()->get('email'));
        $this->teams = team::where('created_by', $user->id)->pluck('team_name', 'id')->toArray();
    }


    public function editTask($id)
    {
        $task = task::where('id', $id)->first();
        if ($task)
        {
            $this->edit_task_id = $task->id;
            $this->edit_task_name = $task->task_name;
            $this->edit_task_description = $task->task_description;
            $this->edit_due_date = $task->due_date;
            if ($task->project_id != null)
            {
                $this->edit_projectId =$task->project_id ;
            }
            if ($task->label_id != null)
            {
                $this->edit_labelId = $task->label_id;
            }
            if ($task->team_id != null)
            {
                $this->edit_teamId = $task->team_id;
            }
            $this->edit_priority = $task->priority;
        }
    }

    public function clear()
    {
        $this->reset(['edit_task_name','edit_task_description','edit_due_date','edit_projectId','edit_labelId','edit_teamId','edit_priority']);
    }

    public function updateTask()
    {
        task::where('id',$this->edit_task_id)->update(['task_name'=>$this->edit_task_name,'task_description'=>$this->edit_task_description,'due_date'=>$this->edit_due_date,'priority'=>$this->edit_priority,'project_id' => $this->edit_projectId !== '' ? $this->edit_projectId : null,'label_id' => $this->edit_labelId !== '' ? $this->edit_labelId : null,'team_id' => $this->edit_teamId !== '' ? $this->edit_teamId : null]);


        $this->dispatch('close-model');
        $this->clear();

        session()->flash('success','Task Updated');

    }

    public function deleteTask($id)
    {
        task::where('id', $id)->delete();
        session()->flash('success','Task Deleted');


    }

    public function toggleTaskStatus($id)
    {
        $task = task::where('id', $id)->first();

        if ($task) {
            $task->completed = !$task->completed;
            $task->save();
            session()->flash('success','Task Completed');

        }
    }
    function filterByTaskName($tasks)
    {
        return $tasks->filter(function ($task) {
            return stripos($task->task_name, $this->searchedTasks) !== false;
        });
    }

     function filterByPriority($tasks)
    {
        return $tasks->filter(function ($task) {
            return $task->priority == $this->priorityFilter;
        });
    }

     function filterByLabel($tasks)
    {
        return $tasks->filter(function ($task) {
            return $task->label_id == $this->labelFilter;
        });
    }

     function filterByProject($tasks)
    {
        return $tasks->filter(function ($task) {
            return $task->project_id == $this->projectFilter;
        });
    }

   function filterByDueDate($tasks)
    {
        return $tasks->filter(function ($task) {
            return $task->due_date == $this->dueDateFilter;
        });
    }
   function getFilteredTasks($updatedTasks)
    {
        if ($this->searchedTasks) {
            $updatedTasks = $this->filterByTaskName($updatedTasks);
        }

        if ($this->priorityFilter) {
            $updatedTasks = $this->filterByPriority($updatedTasks);
        }

        if ($this->labelFilter) {
            $updatedTasks = $this->filterByLabel($updatedTasks);
        }

        if ($this->projectFilter) {
            $updatedTasks = $this->filterByProject($updatedTasks);
        }

        if ($this->startDate && $this->endDate) {
            $updatedTasks = $this->getTaskBetweenGivenDateRange($updatedTasks,$this->startDate,$this->endDate);
        }
        return $updatedTasks;
    }

    function getTaskBetweenGivenDateRange($updatedTasks,$startDate,$endDate)
    {
        $filteredTasks = $updatedTasks->filter(function ($task) use ($startDate, $endDate) {
            $dueDateWithinRange = Carbon::parse($task->due_date)->between($startDate, $endDate);
            $taskDurationWithinRange = Carbon::parse($task->due_date)->greaterThanOrEqualTo($startDate) &&
                                       Carbon::parse($task->due_date)->lessThanOrEqualTo($endDate);

            return ($dueDateWithinRange || $taskDurationWithinRange);
        });

        // Sort the tasks by due date
        $sortedTasks = $filteredTasks->sortBy(function ($task) {
            return Carbon::parse($task->due_date)->timestamp;
        });
        return $sortedTasks;
    }
    public function commonMount()
    {
        $this->loadProjects();
        $this->loadLabels();
        $this->loadTeams();

    }
}
