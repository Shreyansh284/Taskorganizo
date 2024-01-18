<?php

namespace App\Http\Controllers;

use App\Models\label;
use App\Models\project;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\task;
use Illuminate\Http\Request;
use stdClass;

class taskcontroller extends Controller
{




    function addTask(Request $request)
    {
            $userEmail = session()->get('email');
        $user = $this->getUserByEmail($userEmail);
        $project = $this->getProjectByProjectName($request->projectName, $user->id);
        $label = $this->getLabelByLabelName($request->labelName, $user->id);

        $task = new task;
        $task->user_id = $user->id;
        if ($request->filled('project')) {
            $task->project_id = $project->id;
        } else {
            $task->project_id = null;
        }
        if ($request->filled('label')) {
            $task->label_id = $label->id;
        } else {
            $task->label_id = null;
        }
        $task->task_name = $request->task_name;
        $task->task_description = $request->task_description;
        $task->due_date = $request->due_date;
        $task->priority = $request->filled('priority') ? $request->priority : 'low';
        $task->save();

        if ($task) {
            session()->flash('success', 'Succusfully Added Task');
            return back();
        } else {
            session()->flash('error', 'Error Occured While Adding Task');
            return back();
        }


    }

    static function getTasksByEmail($email)
    {
        $user = User::where('email', $email)->first();

        return taskcontroller::getTasksByUserId($user->id);
    }
    static function getTasksByUserId($userId)
    {
        $userTasks = task::where('user_id', $userId)->get();

        $tasks = taskcontroller::addTaskFields($userTasks,null,null);

        return with($tasks);
    }
    function getTasksByPriority(Request $request, $priority)
    {
        $email = session()->get('email');
        $user = $this->getUserByEmail($email);
        $userTasks = task::where('user_id', $user->id)->where('priority', $priority)->get();

        $tasks = taskcontroller::addTaskFields($userTasks,null,null);

        return view('tasksByPriority')->with('tasks', $tasks);
    }
    public function getTasksByProjects(Request $request, $projectName)
    {
        $email = session()->get('email');
        $user = $this->getUserByEmail($email);
        $project = $this->getProjectByProjectName($projectName, $user->id);
        $userTasks = task::where('user_id', $user->id)->where('project_id', $project->id)->get();

        $tasks = taskcontroller::addTaskFields($userTasks,$projectName,null);

        return view('tasksByProject')->with('tasks', $tasks);
    }

    public function getTasksByLabels(Request $request, $labelName)
    {
        $email = session()->get('email');
        $user = $this->getUserByEmail($email);
        $label = $this->getLabelByLabelName($labelName, $user->id);

        $userTasks = task::where('user_id', $user->id)->where('label_id', $label->id)->get();

        $tasks = taskcontroller::addTaskFields($userTasks,null,$labelName);

        return view('tasksByLabel')->with('tasks', $tasks);
    }


    function updateTask(Request $request, $user_id, $id)
    {
        $task = task::where('id', $id)->where('user_id', $user_id)->update(['task_name' => $request->task_name, 'task_description' => $request->task_description, 'due_date' => $request->due_date, 'priority' => $request->priority]);
        if ($task) {
            return response()->json(['message' => 'Task Updated'], 200);
        } else {
            return response()->json(['message' => 'NOT FOUND'], 404);
        }
    }

    function deleteTask(Request $request, $user_id, $id)
    {
        $deleteTask = task::where('id', $id)->where('user_id', $user_id)->delete();

        if ($deleteTask) {
            return response()->json(['message' => 'Task Deleted'], 200);
        } else {
            return response()->json(['message' => 'NOT FOUND'], 404);
        }
    }


    private function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }
    private function getProjectByProjectName($projectName, $userId)
    {
        return project::where('project_name', $projectName)->where('user_id', $userId)->first();
    }
    private function getLabelByLabelName($labelName, $userId)
    {
        return label::where('label_name', $labelName)->where('user_id', $userId)->first();
    }
    static private function getProjectByProjectId($projectId)
    {
        return project::where('id', $projectId)->first();
    }
    static private function getLabelByLabelId($labelId)
    {
        return label::where('id', $labelId)->first();
    }
    static private function addTaskFields($userTask,$projectName,$labelName)
    {
        $tasks = [];
        foreach ($userTask as $task) {

            $newObject = new stdClass();

            taskcontroller::transformTaskModel($newObject,$task,$projectName,$labelName);

            array_push($tasks, $newObject);
        }
        return $tasks;
    }

    static private function transformTaskModel($newObject,$task,$projectName,$labelName)
    {



        $taskToArray = $task->toArray();
        //ADDING TASK FIELDS WITHOUT PROJECT_ID AND LABEL_ID
        foreach ($taskToArray as $key => $value)
        if ($key !== 'project_id' && $key !== 'label_id') {
            $newObject->$key = $value;
        }

        // ADDING PROJECTNAME IF AVILABLE ELSE IF FETCHING IT FROM DATABASE

        if($projectName!=null)
        {
            $newObject->projectName=$projectName;
        }
        else
        {
            $project = taskcontroller::getProjectByProjectId($task->project_id);
            if($project!=null)
            {
            $newObject->projectName = $project->project_name;
            }

        }

         // ADDING LABELNAME IF AVILABLE ELSE IF FETCHING IT FROM DATABASE

        if($labelName!==null)
        {
            $newObject->labelName=$labelName;
        }
        else
        {
            $label = taskcontroller::getLabelByLabelId($task->label_id);
            if($label!=null)
            {
            $newObject->labelName = $label->label_name;
            }
        }
        return $newObject;
    }
}
