<?php

namespace App\Livewire;


use App\Models\project;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Projects extends Component
{
    public $project_name;
    public $edit_project_name;
    public $project_id;

    public function addProject(Request $request)
    {
        $email = session()->get('email');
        $user = getUserByEmail($email);
        $this->validate([
            'project_name' => 'required|unique:projects,project_name,NULL,id,user_id,' . $user->id,
        ]);
        $project = new project;
        $project->user_id = $user->id;
        $project->project_name = $this->project_name;
        $checkprojectAdded = $project->save();
        if ($checkprojectAdded) {
            $this->reset(['project_name']);
            $this->dispatch('close-model');
        }
    }
    public function deleteProject($id)
    {
        project::where('id', $id)->delete();
        notify()->success('Project Deleted');
    }

    public function editProject($id)
    {
        $project = project::where('id', $id)->first();
        if ($project) {
            $this->project_id = $project->id;
            $this->edit_project_name = $project->project_name;
        }
    }

    public function updateProject()
    {
        $email = session()->get('email');
        $user = getUserByEmail($email);
        $this->validate([
            'edit_project_name' => 'required|unique:projects,project_name,NULL,id,user_id,' . $user->id,
        ]);
        project::where('id', $this->project_id)->update(['project_name' => $this->edit_project_name]);
        notify()->success('Project Updated');
        $this->dispatch('close-model');
    }
    public function render()
    {
        $email = session()->get('email');
        $user = getUserByEmail($email);
        $projects = project::where('user_id', $user->id)->latest()->get();

        return view('livewire.projects')->with('projects', $projects);
    }

}
