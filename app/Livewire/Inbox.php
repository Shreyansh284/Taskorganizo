<?php
namespace App\Livewire;
use App\Models\label;
use App\Models\project;
use App\Models\task;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use stdClass;

class Inbox extends Component
{


    public $getTasks="";

    public function deleteTask($id)
    {
        task::where('id', $id)->delete();
    }

    public function toggle($id)
    {

        $task=task::where('id',$id)->first();
        $task->completed = !$task->completed;
        $task->save();

    }

    #[On('taskAdded')]
    public function render()
    {

        $user = getUserByEmail(session()->get('email'));

        $tasks=task::where('user_id',$user->id)->where('completed','0')
        ->where(function ($query)
        {
            $query->where('task_name', 'like', '%' . $this->getTasks . '%')
                ->orwhere('priority','like','%'.$this->getTasks.'%');
        })->latest()->get();
        duedate($tasks);
        $tasks = addTaskFields($tasks,null,null);



        return view('livewire.inbox')->with('tasks',$tasks);
    }




}
