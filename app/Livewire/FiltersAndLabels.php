<?php

namespace App\Livewire;

use App\Models\label;
use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;

class FiltersAndLabels extends Component
{

    public $label_name;
    public $label_id;
    public function addLabel(Request $request)
    {
        $email = session()->get('email');
        $user = getUserByEmail($email);
        $this->validate([
            'label_name' => 'required|unique:labels,label_name,NULL,id,user_id,' . $user->id,
        ]);
        $label = new label;
        $label->user_id = $user->id;
        $label->label_name = $this->label_name;
        $checkLabelAdded = $label->save();
        if ($checkLabelAdded) {
            $this->reset(['label_name']);
        }
       dd($this->dispatch('close-modal'));
    }

    public function deleteLabel($id)
    {
        label::where('id', $id)->delete();

    }
    public function editLabel($id)
    {
        $label = label::where('id', $id)->first();
        if ($label) {
            $this->label_id = $label->id;
            $this->label_name = $label->label_name;
        }
    }
    public function updateLabel()
    {
        $email = session()->get('email');
        $user = getUserByEmail($email);
        $this->validate([
            'label_name' => 'required|unique:labels,label_name,NULL,id,user_id,' . $user->id,
        ]);

        label::where('id', $this->label_id)->update(['label_name' => $this->label_name]);

        $this->dispatch('close-modal');

    }
    public function render()
    {
        $email = session()->get('email');
        $user = getUserByEmail($email);
        $labels = label::where('user_id', $user->id)->latest()->get();
        return view('livewire.filters-and-labels')->with('labels', $labels);
    }

}
