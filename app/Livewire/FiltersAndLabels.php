<?php

namespace App\Livewire;

use App\Models\label;
use App\Models\User;
use Livewire\Component;

class FiltersAndLabels extends Component
{


    
    public function render()
    {
        $email=session()->get('email');
        $user = User::where('email', $email)->first();
        $labels = label::where('user_id', $user->id)->get("label_name");

        return view('livewire.filters-and-labels')->with('labels',$labels);
    }
}
