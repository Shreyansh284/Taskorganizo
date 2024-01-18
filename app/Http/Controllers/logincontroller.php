<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Http\Request;

class logincontroller extends Controller
{

    public function loginAuth(Request $requestLogin)
    {
        $requestLogin->validate
        (
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email Field is required',
            ],
        );

        $userDetails = logincontroller::getUserByEmail($requestLogin->email);

        if ($userDetails != null) {
            $checkPassword = Hash::check($requestLogin->password, $userDetails->password);
            if ($checkPassword) {
                session()->put('email', $requestLogin->email);
                session()->flash('success', 'Logged In !!');
                return redirect('index');
            } else {
                session()->flash('error', 'INVALID PASSWORD');
                return redirect('login');
            }
        } else {
            session()->flash('error', 'INVALID USER');
            return redirect('login');
        }
    }

    public function logout()
    {
        session()->forget('email');
        session()->flash('success', 'Your account was logged out successfully');
        return redirect('login');
    }


    function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
