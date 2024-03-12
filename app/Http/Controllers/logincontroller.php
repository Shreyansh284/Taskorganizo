<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class logincontroller extends Controller
{
    public function loginAuth(Request $requestLogin)
    {
        $this->loginValidation($requestLogin);
        $user = getUserByEmail($requestLogin->email);

        if($this->checkUser($requestLogin,$user))
        {

            return redirect('inbox');
        }
        else
        {
            return redirect('login');
        }
    }
    public function logout()
    {
        session()->forget('email');
        session()->flash('success','Logged Out Successfully');
        return redirect('login');
    }

    private function loginValidation(Request $request)
    {
        return $request->validate
        (
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
        );

    }

    private function checkUser($requestLogin,$user )
    {
        if($user == null)
        {
            session()->flash('error','INVALID USER');
            notify()->error('INVALID USER');
            return false;
        }

        if($this->checkPassword($requestLogin,$user))
        {
            session()->flash('success','Logged In Successfully');
            return true;
        }
        else
        {
            session()->flash('error','INVALID PASSWORD');
                return false;
        }
    }
    private function checkPassword($requestLogin,$user)
    {
        $checkPassword = Hash::check($requestLogin->password, $user->password);
        if ($checkPassword)
        {
            session()->put('email', $requestLogin->email);

             return true;
        }
        else
        {
            return false;
        }

    }
}
