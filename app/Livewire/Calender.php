<?php

namespace App\Livewire;

use App\Models\task;
use Livewire\Attributes\On;
use Livewire\Component;

class Calender extends Component
{
    public $tasks;

    public function mount()
    {
        $user = getUserByEmail(session()->get('email'));
        $this->tasks = task::where('user_id', $user->id)->get();

    }
    #[On('taskAdded')]
    public function render()
    {
        return view('livewire.calender');
    }
}
