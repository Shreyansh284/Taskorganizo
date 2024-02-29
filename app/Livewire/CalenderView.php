<?php

namespace App\Livewire;

use App\Models\task;
use App\Traits\TaskTrait;
use Carbon\CarbonPeriod;
use Livewire\Attributes\On;
use Livewire\Component;
use Carbon\Carbon;

class CalenderView extends Component
{

    use TaskTrait;
    public $startDate;
    public $endDate;

    #[On('taskAdded')]
    public function mount()
    {
        $this->startDate = now()->toDateString();
        $this->endDate = now()->addDays(6)->toDateString();

        $this->commanMount();
    }
    public function render()
    {
        $user = getUserByEmail(session()->get('email'));

        $tasks = getTasksWithinDateRange($user->id, $this->startDate, $this->endDate);

        $updatedTasks = getUpdatedTasks($tasks);
        $updatedTasks = collect($updatedTasks);
        $updatedTasks = $this->getFilteredTasks($updatedTasks);

        getFormetedDuedate($updatedTasks);
        $datesWithTasks = $this->organizeTasksByDate($updatedTasks, $this->startDate, $this->endDate);

        $dates = Carbon::parse($this->startDate)->toPeriod($this->endDate)->toArray();

        return view('livewire.calender-view', compact('datesWithTasks', 'dates'));
    }
    private function organizeTasksByDate($tasks, $startDate, $endDate)
    {
        $datesWithTasks = [];

        foreach (Carbon::parse($startDate)->toPeriod($endDate) as $date) {
            $formattedDate = $date->format('D, M j');
            $datesWithTasks[$formattedDate] = $tasks->where('due_date', $formattedDate)->toArray();
        }
        return $datesWithTasks;
    }
}

