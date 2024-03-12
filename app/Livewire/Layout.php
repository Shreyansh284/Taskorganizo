<?php

namespace App\Livewire;

use App\Models\label;
use App\Models\project;
use App\Models\task;
use App\Models\team;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Http\Request;

class Layout extends Component
{
    public $task_name;
    public $task_description;
    public $due_date;
    public $priority;
    public $projectId;
    public $labelId;
    public $teamId;

    public function addTask(Request $request)
    {
        $email = session()->get('email');
        $user = getUserByEmail($email);
        $task = new task;
        $task->user_id = $user->id;
        if ($this->projectId !== null) {
            $task->project_id = $this->projectId;
        } else {
            $task->project_id = null;
        }
        if ($this->labelId !== null) {
            $task->label_id = $this->labelId;
        } else {
            $task->label_id = null;
        }
        if ($this->teamId !== null) {
            $task->team_id = $this->teamId;
        } else {
            $task->team_id = null;
        }
        $task->task_name = $this->task_name;
        $task->task_description = $this->task_description;
        $task->due_date = $this->due_date;
        $task->priority = $this->priority ? $this->priority : 'low';

        $task->save();

        $this->reset();
        $this->dispatch('taskAdded');
        $this->dispatch('close-model');
        notify()->success('Task Added');
    }
    public function render()
    {
        $email = session()->get('email');
        $user = getUserByEmail($email);
        $projects = project::where('user_id', $user->id)->get();
        $labels = label::where('user_id', $user->id)->get();
        $teams = team::where('created_by', $user->id)->get();

        return view('livewire.layout', ['projects' => $projects, 'labels' => $labels,'teams'=>$teams]);
    }
}
