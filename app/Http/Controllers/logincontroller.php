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

            return redirect('index');
        }
        else
        {
            return redirect('login');
        }
    }
    public function logout()
    {
        session()->forget('email');
        notify()->success('Logged Out Successfully');
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
            notify()->error('INVALID USER');
            return false;
        }

        if($this->checkPassword($requestLogin,$user))
        {
            notify()->success('Logged In Successfully');
            return true;
        }
        else
        {
            notify()->error('INVALID PASSWORD');

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
