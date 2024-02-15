<?php
namespace App\Livewire;


use App\Models\label;
use App\Models\project;
use App\Models\task;
use App\Traits\TaskEditDeleteTrait;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use stdClass;
use App\CustomModels\TaskData;


class Inbox extends Component
{

    use TaskEditDeleteTrait;
    public $taskType;
    public $edit_task_id;
    public $edit_task_name = "";
    public $edit_task_description;
    public $edit_due_date;
    public $edit_priority;
    public $edit_projectId;
    public $edit_labelId;
    public $searchedTasks = "";
    public $priorityFilter = "";
    public $labelFilter = "";
    public $dueDateFilter = "";
    public $projectFilter = "";
    public $projects = [];
    public $labels = [];


    public function mount()
    {
        $this->loadProjects();
        $this->loadLabels();
    }

    public function loadProjects()
    {
        $user = getUserByEmail(session()->get('email'));
        $this->projects = Project::where('user_id', $user->id)->pluck('project_name', 'id')->toArray();
    }
    public function loadLabels()
    {
        $user = getUserByEmail(session()->get('email'));
        $this->labels = Label::where('user_id', $user->id)->pluck('label_name', 'id')->toArray();
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
            $this->edit_priority = $task->priority;

        }
    }

    public function clear()
    {
        $this->reset(['edit_task_name','edit_task_description','edit_due_date','edit_projectId','edit_labelId','edit_priority']);
    }

    public function updateTask()
    {
        task::where('id',$this->edit_task_id)->update(['task_name'=>$this->edit_task_name,'task_description'=>$this->edit_task_description,'due_date'=>$this->edit_due_date,'priority'=>$this->edit_priority,'project_id'=>$this->edit_projectId,'label_id'=>$this->edit_labelId]);
    }



    #[On('taskAdded')]
    public function render()
    {
        $tasks = $this->getTasks();

        $updatedTasks=getUpdatedTasks($tasks);

        if ($this->searchedTasks) {
            $updatedTasks = $this->filterByTaskName(collect($updatedTasks));
        }

        if ($this->priorityFilter) {
            $updatedTasks = $this->filterByPriority(collect($updatedTasks));
        }

        if ($this->labelFilter) {
            $updatedTasks = $this->filterByLabel(collect($updatedTasks));
        }

        if ($this->projectFilter) {
            $updatedTasks = $this->filterByProject(collect($updatedTasks));
        }

        if ($this->dueDateFilter) {
            $updatedTasks = $this->filterByDueDate(collect($updatedTasks));
        }
        return view('livewire.inbox', ['tasks' => $updatedTasks]);
    }


    private function getTasks()
    {
        $user = getUserByEmail(session()->get('email'));

        if ($this->taskType == 'not_completed')
        {
            $tasks = getNotCompletedTasks($user->id);
        }
        elseif($this->taskType == 'completed')
        {
            $tasks = getCompletedTasks($user->id);
        }
        elseif($this->taskType =='today')
        {
            $tasks =getTasksWhereDueDateIsToday($user->id);
        }
        getFormetedDuedate($tasks);
        return $tasks;
    }

     function filterByTaskName($tasks)
    {
        return $tasks->filter(function ($task) {
            return stripos($task->task_name, $this->searchedTasks) !== false;
        });
    }

    private function filterByPriority($tasks)
    {
        return $tasks->filter(function ($task) {
            return $task->priority == $this->priorityFilter;
        });
    }

    private function filterByLabel($tasks)
    {
        return $tasks->filter(function ($task) {
            return $task->label_id == $this->labelFilter;
        });
    }

    private function filterByProject($tasks)
    {
        return $tasks->filter(function ($task) {
            return $task->project_id == $this->projectFilter;
        });
    }

    private function filterByDueDate($tasks)
    {
        return $tasks->filter(function ($task) {
            return $task->due_date == $this->dueDateFilter;
        });
    }

}
