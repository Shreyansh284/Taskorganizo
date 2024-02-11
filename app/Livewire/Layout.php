<?php

namespace App\Livewire;

use App\Models\label;
use App\Models\project;
use App\Models\task;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Http\Request;
class Layout extends Component
{
    public $task_name;
    public $task_description;
    public $due_date;
    public $priority;
    public $projectName;
    public $labelName;

    public function addTask(Request $request)
    {
        $email = session()->get('email');
        $user = getUserByEmail($email);
        $project = $this->getProjectByProjectName($this->projectName, $user->id);
        $label = $this->getLabelByLabelName($this->labelName, $user->id);


            // dd($this->task_name);
        $task = new task;
        $task->user_id = $user->id;
        if ($this->projectName!==null) {
            $task->project_id = $project->id;
        } else {
            $task->project_id = null;
        }
        if ($this->labelName!==null) {
            $task->label_id = $label->id;
        } else {
            $task->label_id = null;
        }
        $task->task_name = $this->task_name;
        $task->task_description = $this->task_description;
        $task->due_date = $this->due_date;
        $task->priority = $this->priority ? $this->priority : 'low';
        $task->save();

        $this->reset();
        $this->dispatch('taskAdded');
        $this->dispatch('closeTaskModal');
    }
    public function getProjectByProjectName($projectName, $userId)
    {
        return project::where('project_name', $projectName)->where('user_id', $userId)->first();
    }
    public function getLabelByLabelName($labelName, $userId)
    {
        return label::where('label_name', $labelName)->where('user_id', $userId)->first();
    }
    public function render()
    {
        $email=session()->get('email');
        $user = getUserByEmail($email);
        $projects = project::where('user_id', $user->id)->get("project_name");
        $labels = label::where('user_id', $user->id)->get("label_name");

        return view('livewire.layout',['projects'=>$projects,'labels'=>$labels]);
    }
}
