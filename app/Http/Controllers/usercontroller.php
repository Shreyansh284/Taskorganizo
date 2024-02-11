<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class usercontroller extends Controller
{
    public function addUser(Request $requestUser)
    {

        $rules = [
            'name' => 'required|regex:/^[A-Za-z_]{1,40}+$/',
            'email' => 'required|email',
            'password' => 'required|regex:/^[a-zA-Z_0-9]{8,}+$/|confirmed',
            'password_confirmation' => 'required',
        ];
        $custom_error = [
            'name.required' => 'The name field cannot be empty',
            'name.regex' => 'Enter numbers and special characters not allowed ',
            'email.required' => 'email is required',
            'email.max' => 'The email maxmimum length is 40 characters',
            'password.required' => 'The password field is required',
            'password.regex' => 'Enter minimum 8 digit/letter ',
        ];
        $requestUser->validate($rules, $custom_error);

        $user= new User;
        $user->name = $requestUser->name;
        $user->email = $requestUser->email;
        $user->password = $requestUser->password;
        $user->save();

        return redirect('index');
    }
    public function updateUser(Request $request, $id)
    {
        $user = DB::table('users')->where('id', $id)->update(['name' => $request->name, 'email' => $request->email]);
        if ($user) {
            return response()->json(['message' => 'USER UPDATED'], 200);
        } else {
            return response()->json(['message' => 'USER NOT FOUND'], 404);
        }
    }
    public function deleteUser(Request $request, $id)
    {

        $user = DB::table('users')->where('id', $id)->delete();
        if ($user) {
            return response()->json(['message' => 'USER Deleted'], 200);
        } else {
            return response()->json(['message' => 'NOT FOUND'], 404);
        }


    }








}
