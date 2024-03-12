<?php
namespace App\Livewire;


use App\Models\label;
use App\Models\project;
use App\Models\task;
use App\Traits\TaskTrait;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use stdClass;
use App\CustomModels\TaskData;
use Livewire\WithPagination;


class Inbox extends Component
{

    use WithPagination;
    use TaskTrait;
    #[On('taskAdded')]
    public function mount()
    {
        $this->commonMount();
    }
    public function render()
    {
        $user = getUserByEmail(session()->get('email'));

        $tasks = getNotCompletedTasks($user->id);

        $updatedTasks = getUpdatedTasks($tasks);
        $updatedTasks = collect($updatedTasks);
        getFormetedDuedate($updatedTasks);
        $updatedTasks = $this->getFilteredTasks($updatedTasks);
        return view('livewire.inbox', ['tasks' => $updatedTasks, 'user_id' => $user->id]);
    }


}
