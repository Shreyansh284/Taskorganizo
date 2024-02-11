<?php

namespace App\Livewire;

use App\Models\project;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Projects extends Component
{
    public $project_name;
    public $edit_project_name;


    public function addProject(Request $request)
    {
        // dd($this->project_name);
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
            $this->dispatch('closeProjectModal');
        }
    }
    public function deleteProject($id)
    {
        project::where('id', $id)->delete();
    }
    public function editProject($id)
    {

        project::where('id',$id)->update(['project_name'=>$this->edit_project_name]);
    }
    public function redirectToProjectTasks($project_name)
    {
        // Redirect to the ProjectTasks Livewire component with the project ID
        return redirect()->to("/projects/$project_name");
    }
    public function render()
    {
        $email = session()->get('email');
        $user = getUserByEmail($email);
        $projects = project::where('user_id', $user->id)->latest()->get();

        return view('livewire.projects')->with('projects', $projects);
    }

}
