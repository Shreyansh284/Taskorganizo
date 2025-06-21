<?php

namespace App\Livewire;

use App\Models\User;
use \App\Models\team;
use Livewire\Component;

class Teams extends Component
{
    public $team_name;
    public $edit_team_name;
    public $team_id;

    public function addTeam()
    {
        $email = session()->get('email');
        $user = getUserByEmail($email);
        $this->validate([
            'team_name' => 'required|unique:teams,team_name,NULL,id,created_by,' . $user->id,
        ]);
        $team=new team;
        $team->team_name=$this->team_name;
        $team->created_by=$user->id;
        $team->save();
        $team->teamUsers()->attach($user->id,['status' => 'Accepted']);

        if ($team) {
            $this->reset(['team_name']);
            $this->dispatch('close-model');
        }
    }
    public function deleteTeam($id)
    {
        team::where('id', $id)->delete();
        notify()->success('Team Deleted');
    }
    public function editTeam($id)
    {
        $team = team::where('id', $id)->first();

        if ($team) {
            $this->team_id = $team->id;
            $this->edit_team_name = $team->team_name;
        }
    }
    public function updateTeam()
    {
        $email = session()->get('email');
        $user = getUserByEmail($email);
        $this->validate([
            'edit_team_name' => 'required|unique:teams,team_name,NULL,id,created_by,' . $user->id,
        ]);
        team::where('id', $this->team_id)->update(['team_name' => $this->edit_team_name]);

        $this->dispatch('close-model');

        session()->flash('success', 'Team Name Updated');
    }

    public function render()
    {
        $user = getUserByEmail( session()->get('email'));

        $allTeams=user::find($user->id)->usersTeams;
        // dd($allTeams);

        $teamsCreatedByUser=$allTeams->filter(function ($team) use ($user) {
            return $team->created_by == $user->id;
        });
        $teamsIAmMemberOf =$allTeams->filter(function ($team) use ($user) {
            return $team->created_by !== $user->id && $team->pivot->status=='Accepted';
        });

        return view('livewire.teams',['myTeams'=>$teamsCreatedByUser,'memberTeams'=>$teamsIAmMemberOf ]);
    }
}
