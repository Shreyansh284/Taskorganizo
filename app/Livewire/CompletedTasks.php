<?php

namespace App\Livewire;

use App\Models\label;
use App\Models\project;
use App\Models\task;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use stdClass;
class CompletedTasks extends Component
{
    public function toggle($id)
    {

         $task=task::where('id',$id)->first();
         $task->completed = !$task->completed;
         $task->save();

    }


    public function render()
    {
        $user = getUserByEmail(session()->get('email'));

        $tasks=task::where('user_id',$user->id)->where('completed', '1')->get();
        duedate($tasks);
        $tasks = addTaskFields($tasks,null,null);


        return view('livewire.completed-tasks')->with('tasks',$tasks);
    }
}
