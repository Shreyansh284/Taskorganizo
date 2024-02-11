<?php

namespace App\Livewire;
use Illuminate\Http\Request;
use Livewire\Component;

class Secondlivewire extends Component
{

    public function second(Request $request)
    {


            // $this->reset(['project_name']);
            $this->dispatch('closesecond');

    }
    public function render()
    {
        return view('livewire.secondlivewire');
    }
}
