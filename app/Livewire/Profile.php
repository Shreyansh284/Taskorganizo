<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    public $user_name;
    public $user_email;
    public $user_id;
    public $current_password;
    public $password;
    public $password_confirmation;

    public function updateProfile()
    {
        $this->validate([
            'user_name' => 'required',
        ]);

        User::where('id', $this->user_id)->update(['name' => $this->user_name]);
    }

    public function changePassword()
    {
        $this->validate([
            'current_password' => 'required|regex:/^[a-zA-Z_0-9]{8,16}+$/',
            'password' => 'required|regex:/^[a-zA-Z_0-9]{8,16}+$/',
            'password_confirmation' => 'required',
        ]);
        $user = getUserByEmail(session()->get('email'));
        $checkPassword = Hash::check($this->current_password, $user->password);
        if ($checkPassword) {
            if ($this->password != $this->current_password) {
                if ($this->password == $this->password_confirmation) {
                    $user->where('id', $user->id)->update(['password' => Hash::make($this->password)]);
                } else {
                    $this->addError('password_confirmation', 'Confirm password is not matching');
                }
            } else {
                $this->addError('password', ' Current password and New password are same');
            }
        } else {
            $this->addError('current_password', 'Entered password is not matching with current password');
        }

        $this->reset(['password_confirmation', 'password', 'current_password']);
    }
    public function render()
    {
        $user = getUserByEmail(session()->get('email'));

        $this->user_id = $user->id;
        $this->user_name = $user->name;
        $this->user_email = $user->email;

        return view('livewire.profile');
    }
}
