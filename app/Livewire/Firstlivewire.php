<?php

namespace App\Livewire;
use Illuminate\Http\Request;

use Livewire\Component;

class Firstlivewire extends Component
{


    // public function first(Request $request)
    // {
    //         // $this->reset(['project_name']);
    //         $this->dispatch('closefirst');

    // }
    public function render()
    {
        return view('livewire.firstlivewire')->layout('master');
    }
}
