<?php

namespace App\Livewire;

use App\Models\task;
use App\Traits\TaskEditDeleteTrait;
use Carbon\CarbonPeriod;
use Livewire\Component;
use Carbon\Carbon;

class UpcomingTasks extends Component
{

    use TaskEditDeleteTrait;
    public function render()
    {
        $user = getUserByEmail(session()->get('email'));
        $startDate = now();
        $endDate = now()->addDays(6);

        $datesWithTasks=task::where('completed','0')->get();
        $datesWithTasks = task::where('user_id',$user->id)->whereBetween('due_date', [$startDate, $endDate])
            ->where('completed', 0)
            ->get()
            ->groupBy(function($date){
                return Carbon::parse($date->due_date)->format('Y-m-d');
            });
            // $datesWithTasks = addTaskFields($datesWithTasks, null, null);
            // dd($datesWithTasks);
        $dates =  CarbonPeriod::create($startDate, $endDate);


        return view('livewire.upcoming-tasks', ['datesWithTasks' => $datesWithTasks, 'dates' => $dates]);
    }

}
