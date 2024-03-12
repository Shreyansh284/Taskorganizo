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
        $this->commonMount();
    }
    public function render()
    {
        $user = getUserByEmail(session()->get('email'));

        $tasks = getTasksWithinDateRange($user->id, $this->startDate, $this->endDate);

        $updatedTasks = getUpdatedTasks($tasks);
        $updatedTasks = collect($updatedTasks);
        $updatedTasks = $this->getFilteredTasks($updatedTasks);

        getFormetedDuedate($updatedTasks);

        $datesWithTasks = [];
        $dates = [];

        if ($this->startDate !== null && $this->endDate !== null) {
            $dates = Carbon::parse($this->startDate)->toPeriod($this->endDate)->toArray();
            $datesWithTasks = $this->organizeTasksByDate($updatedTasks, $this->startDate, $this->endDate);
        }
        return view('livewire.calender-view', ['datesWithTasks' => $datesWithTasks, 'user_id' => $user->id, 'dates' => $dates]);
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
    public function renderAfterSubmit()
    {
        $this->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);
        $this->render();
    }


}

