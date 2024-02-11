<?php

namespace App\Livewire;
use App\Models\label;
use App\Models\project;
use App\Models\task;
use Illuminate\Support\Carbon;

use Livewire\Attributes\On;
use Livewire\Component;

class TodayTasks extends Component
{
    public $getTasks;
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
     $todayTasks=task::where('user_id',$user->id)->where('completed','0')->where('due_date',today())
        ->where(function ($query)
        {
            $query->where('task_name', 'like', '%' . $this->getTasks . '%')
                ->orwhere('priority','like','%'.$this->getTasks.'%');
        })->latest()->get();

        duedate($todayTasks);

        $todayTasks=addTaskFields($todayTasks,null,null);

        $date=todaydate();

        return view('livewire.today-tasks',['todayTasks'=>$todayTasks],['date'=>$date]);
    }
}
