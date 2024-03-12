<?php

namespace App\Http\Controllers;

use App\Models\password_reset;
use App\Models\Password_reset_tokens;
use App\Models\team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
class usercontroller extends Controller
{
    public function signUp(Request $requestUser)
    {

        $rules = [
            'name' => 'required|regex:/^[a-zA-Z_0-9]{1,40}+$/',
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

        $userExist=User::where('email',$requestUser->email)->first();

        if($userExist!=null)
        {
            return User::where('id', $userExist->id)->update([
                'name' => $requestUser->name,
                'password' => Hash::make($requestUser->password),
            ]);
        }
        else
        {
        $user= new User;
        $user->name = $requestUser->name;
        $user->email = $requestUser->email;
        $user->password = $requestUser->password;
        return $user->save();
        }
    }

    public function addUser(Request $request)
    {

        $useraddded=$this->signUp($request);

        if($useraddded)
        {
            session()->flash('success','Registered Successfully');
            return redirect('login');
        }

    }

    public function addTeam(Request $request ,$user_id)
    {
        $team=new team;
        $team->team_name=$request->team_name;
        $team->save();

        $team->teamUsers()->attach($user_id);

    }

    public function getTeamByUserId($user_id)
    {
        $teamsOfUser=User::find($user_id)->usersTeams;
        return response()->json(['details' => $teamsOfUser], 200);

    }
    public function getUserByTeamId($team_id)
    {
        $usersInTeam=team::find($team_id)->teamUsers;
        return response()->json(['details' => $usersInTeam], 200);

    }
    public function addUserInTeam(Request $request,$team_id)
    {
        $existingUser = User::where('email',$request->email)->first();
        $teamAdmin=team::find($team_id)->teamUsers->first();

        // return response()->json(['details' => $existingUser,'user'=>$teamAdmin], 200);
        if($existingUser)
        {
            $this->sendMailToExisitngUser($existingUser,$teamAdmin,$team_id);
        }
        else
        {
            $this->sendMailToUserForRegister($request,$teamAdmin,$team_id);
        }
    }

    public function sendMailToExisitngUser($user,$teamAdmin,$team_id)
    {
        $team=team::where('id',$team_id)->first();
        $data = ['email' => $user->email,'user_id'=>$user->id, 'name' => $user->name,'adminName'=>$teamAdmin->name,'adminEmail'=>$teamAdmin->email,'team_id'=>$team_id,'team_name'=>$team->team_name ];
         Mail::send('emails.mailForJoiningExisitingUser',['data' => $data], function ($message) use ($data){
            $message->to($data['email'], $data['name']);
            $message->from('taskorganizo@gmail.com','TaskOrganizo');
            $message ->subject($data['adminName']."Invited You To Join Their Team !");
         });
    }

    public function sendMailToUserForRegister($request,$teamAdmin,$team_id)
    {
        $team=team::where('id',$team_id)->first();
        $data = ['email' => $request->email,'adminName'=>$teamAdmin->name,'adminEmail'=>$teamAdmin->email,'team_id'=>$team_id ,'team_name'=>$team->team_name];
        Mail::send('emails.mailForRegisterUserByTeamInvite',['data' => $data], function ($message) use ($data){
           $message->to($data['email']);
           $message->from('taskorganizo@gmail.com','TaskOrganizo');
           $message ->subject($data['adminName']."Invited You To Join Their Team !");
        });
    }
    public function addUserByTeamInvite(Request $request)
    {
        $useraddded=$this->signUp($request);
        if($useraddded)
        {
         return $this->redirectToUserToJoin();
        }
    }
    public function redirectToUserToJoin()
    {
        $teamName = request('team');
        $teamId = request('team_id');
        $teamAdminName = request('adminName');
        $teamAdminEmail = request('adminEmail');
        $user=User::where('email',request('userEmail'))->first();
        $userId=$user->id;

        return view('join', compact(['teamName','teamId','teamAdminName','teamAdminEmail','userId']));

    }
    public function joinExistingUserInTeam($user_id,$team_id)
    {

        $user = User::find($user_id);
        $team = Team::find($team_id);

        if ($user && $team && !$user->usersTeams()->where('team_id', $team_id)->where('status','Accepted')->exists()) {
            $team->teamUsers()->updateExistingPivot($user_id, ['status' => 'Accepted']);
            return redirect('login');
        } else {
            return 'User is already a member of this team. ';
        }
    }
    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email'=>"required|email|exists:users"
        ]);


        $token=Str::random(64);

       $password_reset= new Password_reset_tokens;

       $password_reset->email=$request->email;
       $password_reset->token=Hash::make($token);
       $password_reset->created_at=Carbon::now();
       $password_reset->save();
       $emailAndToken=['email'=>$request->email,'token'=>$token];

       Mail::send('emails.forgetPasswordMail',['info'=>$emailAndToken],function ($message) use ($request){
        $message->to($request->email);
        $message->from('taskorganizo@gmail.com','TaskOrganizo');
        $message->subject("Reset Password");

       });
        session()->flash('success','Reset Link Send To Your Mail');
       return redirect('forgetPassword');

    }
    function resetPassword()
    {
        $token=request('token');
        $email=request('email');
      return view('resetPassword',compact('token','email'));
    }
    function resetPasswordPost( Request $request)
    {
        $request->validate([
            'email'=>"required|email|exists:users",
            'password' => 'required|regex:/^[a-zA-Z_0-9]{8,}+$/|confirmed',
            'password_confirmation' => 'required'
        ]);


        $usertoken=Password_reset_tokens::where('email',$request->email)->first();

        $checkToken=Hash::check($request->token, $usertoken->token);

        if(!$checkToken)
        {
            session()->flash('error','InValid Token');
            return redirect('resetPasswordForm');

        }

        User::where('email',$request->email)->update(["password"=> Hash::make($request->password)]);

        Password_reset_tokens::where('email',$request->email)->delete();

        session()->flash('success','Password Changed Successfully');
        return redirect('login');

    }

}
