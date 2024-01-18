<?php

namespace App\Http\Controllers;

use App\Models\project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use stdClass;

class projectcontroller extends Controller
{
    public function addProject(Request $request)
    {
        $userEmail = session()->get('email');
        $user = projectcontroller::getUserByEmail($userEmail);


        $validator = Validator::make($request->all(), [
            'project_name' => 'required|unique:projects,project_name,user_id'.$user->id,
            // Add validation rules for other fields
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        }


                $project= new project;
                $project->user_id = $user->id;
                $project->project_name=$request->project_name;
                if($project->save())
                {
                return redirect('project');
                }
    }
    static function getProjectsByEmail($email)
    {
        $user=User::where('email',$email)->first();
        $projects = project::where('user_id', $user->id)->get("project_name");
        return with($projects);
    }
    function updateProject(Request $request, $user_id, $id)
    {
        $updateProjectDetail = project::where('id', $id)->where('user_id', $user_id)->update(['project_name' => $request->project_name]);


        if ($updateProjectDetail) {
            return response()->json(['message' => 'project Updated'], 200);
        } else {
            return response()->json(['message' => 'NOT FOUND'], 404);
        }
    }

    function deleteProject(Request $request, $user_id, $id)
    {
        $deleteProject = project::where('id', $id)->where('user_id', $user_id)->delete();

        if ($deleteProject) {
            return response()->json(['message' => 'project delete'], 200);
        } else {
            return response()->json(['message' => 'NOT FOUND'], 404);
        }
    }
    private  function getUserByEmail($email)
    {
        return DB::table('users')->where('email', $email)->first();
    }

}
