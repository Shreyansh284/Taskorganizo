<?php

namespace App\Livewire;

use App\Models\project;
use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class Projects extends Component
{

public $project_name;
public $showModal=false;

public function openModal()
{
    $this->showModal = true;
}

public function closeModal()
{
    $this->showModal = false;
}
    public function addProject(Request $request)
    {

        $userEmail = session()->get('email');
        $user = $this->getUserByEmail($userEmail);
        $this->validate([
            'project_name' => 'required|unique:projects,project_name,NULL,id,user_id,' . $user->id,
        ]);
                $project= new project;
                $project->user_id = $user->id;
                $project->project_name=$this->project_name;
                $checkprojectAdded=$project->save();
                if($checkprojectAdded)
                {
                    $this->reset(['project_name']);
                    session()->flash('added', 'Added');
                    return redirect()->back();

                }


    }


    public function render()
    {
        $email=session()->get('email');
        $user=User::where('email',$email)->first();
        $projects = project::where('user_id', $user->id)->get("project_name");

        return view('livewire.projects')->with('projects',$projects);
    }
    private  function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }


}
