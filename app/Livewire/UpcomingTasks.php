<?php

namespace App\Livewire;

use App\Models\task;
use Livewire\Component;
use Carbon\Carbon;

class UpcomingTasks extends Component
{
    // public $tasks;


    // public function render()
    // {
    //     $user = getUserByEmail(session()->get('email'));
    //     $tasksToday = task::where('user_id',$user->id)->where('completed','0')->where('due_date', today())->get();
    //     $tasksTomorrow = task::where('user_id',$user->id)->where('completed','0')->where('due_date', today()->addDay())->get();
    //     $tasksNext7Days = task::where('user_id',$user->id)->where('completed','0')->where('due_date', today()->addDays(7))->get();
    //     $tasksNext30Days = task::where('user_id',$user->id)->where('completed','0')->where('due_date', today()->addDays(30))->get();



    //     // dd($this->tasks);
    //     return view('livewire.upcoming-tasks', [
    //         'tasksToday' => $tasksToday,
    //         'tasksTomorrow' => $tasksTomorrow,
    //         'tasksNext7Days' => $tasksNext7Days,
    //         'tasksNext30Days' => $tasksNext30Days,
    //         // 'tasksThisMonth' => $this->tasksThisMonth(),
    //         // 'tasksRestOfYear' => $this->tasksRestOfYear(),
    //         // Add more variables for other time intervals
    //     ]);
    // }

    // // public function tasksToday()
    // // {
    // //     return $this->tasks->where('due_date', today());
    // // }

    // // public function tasksTomorrow()
    // // {
    // //     return $this->tasks->where('due_date', today()->addDay());
    // // }

    // // public function tasksNext7Days()
    // // {
    // //     $next7Days = Carbon::today()->addDays(7);
    // //     return $this->tasks->where('due_date', '<=', $next7Days);
    // // }

    // // public function tasksNext30Days()
    // // {
    // //     $next30Days = Carbon::today()->addDays(30);
    // //     return $this->tasks->where('due_date', '<=', $next30Days);
    // // }

    // // public function tasksThisMonth()
    // // {
    // //     $startOfMonth = Carbon::today()->startOfMonth();
    // //     $endOfMonth = Carbon::today()->endOfMonth();
    // //     return $this->tasks->where('due_date', '>', $startOfMonth)->where('due_date', '<=', $endOfMonth);
    // // }

    // // public function tasksRestOfYear()
    // // {
    // //     $endOfYear = Carbon::today()->endOfYear();
    // //     return $this->tasks->where('due_date', '>', Carbon::now())->where('due_date', '<=', $endOfYear);
    // // }

    public $tasks;

    public function mount()
    {
        // Fetch all upcoming tasks
        $this->tasks = Task::where('due_date', '>', now())->orderBy('due_date')->get();
    }

    public function render()
    {
        $groupedTasks = $this->groupTasksByDate($this->tasks);

        return view('livewire.upcoming-tasks', [
            'groupedTasks' => $groupedTasks,
        ]);
    }

    public function toggle($taskId)
    {
        // Implement your toggle logic here
    }

    public function deleteTask($taskId)
    {
        // Implement your delete logic here
    }

    protected function groupTasksByDate($tasks)
    {
        return $tasks->groupBy(function ($task) {
            $dueDate = Carbon::parse($task->due_date);
            $today = Carbon::today();

            if ($dueDate->isSameDay($today)) {
                return 'Today';
            } elseif ($dueDate->isSameDay($today->addDay())) {
                return 'Tomorrow';
            } elseif ($dueDate->isBetween($today, $today->addDays(7))) {
                return 'Next 7 Days';
            } else {
                return $dueDate->format('l, F j, Y');
            }
        });
    }

}
