<?php

namespace App\Livewire;

use App\Models\team;
use App\Models\User;
use App\Traits\TaskTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class TaskAndMemberOfTeam extends Component
{
    use TaskTrait;
    public $team_id;
    public $memberEmail;

    public function mount($team_id)
    {
        $this->team_id = $team_id;
        $this->commonMount();
    }
    public function addUserInTeam()
    {

        $existingUser = User::where('email', $this->memberEmail)->first();

        $teamAdmin = team::find($this->team_id)->teamUsers->first();
        $joinedUser = team::find($this->team_id)->teamUsers->contains('email', $this->memberEmail);

        if ($joinedUser)
        {
            $this->addError('memberEmail', 'The user is already a team member');
        }
         else
        {

            if ($existingUser)
            {
                $this->sendMailToExisitngUser($existingUser, $teamAdmin, $this->team_id);
            }
             else
            {
                User::create(['email'=>$this->memberEmail]);
                $this->sendMailToUserForRegister($this->memberEmail, $teamAdmin, $this->team_id);
            }
        }
    }

    public function sendMailToExisitngUser($user, $teamAdmin, $team_id)
    {
        $team = team::where('id', $team_id)->first();

        $data = ['email' => $user->email, 'user_id' => $user->id, 'name' => $user->name, 'adminName' => $teamAdmin->name, 'adminEmail' => $teamAdmin->email, 'team_id' => $team_id, 'team_name' => $team->team_name];
        Mail::send('emails.mailForJoiningExisitingUser', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'], $data['name']);
            $message->from('taskorganizo@gmail.com', 'TaskOrganizo');
            $message->subject($data['adminName'] . "Invited You To Join Their Team !");
        });

        $team->teamUsers()->attach($user->id);

        $this->reset(['memberEmail']);
        $this->dispatch('close-model');
        session()->flash('success','Invitation Send Successfully');

    }

    public function sendMailToUserForRegister($memberEmail, $teamAdmin, $team_id)
    {
        $team = team::where('id', $team_id)->first();
        $user=User::where('email',$memberEmail)->first();
        $data = ['email' => $memberEmail, 'adminName' => $teamAdmin->name, 'adminEmail' => $teamAdmin->email, 'team_id' => $team_id, 'team_name' => $team->team_name];
        Mail::send('emails.mailForRegisterUserByTeamInvite', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email']);
            $message->from('taskorganizo@gmail.com', 'TaskOrganizo');
            $message->subject($data['adminName'] . "Invited You To Join Their Team !");
        });
        $team->teamUsers()->attach($user->id);
        $this->reset(['memberEmail']);
        $this->dispatch('close-model');
        session()->flash('success','Invitation Send Successfully');
    }

    public function removeMember($user_id,$team_id)
    {
        $team = Team::find($team_id);
        $user = User::find($user_id);
        $team->teamUsers()->detach($user);
        session()->flash('success','Member Removed');
    }
    #[On('taskAdded')]
    public function render()
    {

        $team = team::findOrFail($this->team_id);

        $user = getUserByEmail(session()->get('email'));

        $usersInTeam = Team::find($this->team_id)->teamUsers;

        $tasks = getTasksByTeamId($this->team_id, $user->id);
        $updatedTasks = getUpdatedTasks($tasks);
        $updatedTasks = collect($updatedTasks);
        getFormetedDuedate($updatedTasks);
        $updatedTasks = $this->getFilteredTasks($updatedTasks);

        return view('livewire.task-and-member-of-team', ['users' => $usersInTeam, 'tasks' => $updatedTasks, 'user_id' => $user->id, 'team' => $team]);
    }
}
