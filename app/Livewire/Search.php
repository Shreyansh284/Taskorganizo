<?php

namespace App\Livewire;

use App\Models\task;
use App\Models\User;
use Livewire\Component;

class Search extends Component
{

    public $getTasks="";
    public function render()
    {
        $tasks=[];
        $user = User::where('email', session()->get('email'))->first();
        $tasks=task::where('user_id',$user->id)->where('task_name','like','%'.$this->getTasks.'%')->orwhere('priority','like','%'.$this->getTasks.'%')->get();


        return view('livewire.search')->with('tasks',$tasks);
    }
}
