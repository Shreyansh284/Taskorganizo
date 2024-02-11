<?php

use App\Models\label;
use App\Models\project;
use App\Models\task;
use Illuminate\Support\Carbon;
if (!function_exists('getUserByEmail')) {
    function getUserByEmail($email)
    {
        return \App\Models\User::where('email', $email)->first();
    }
    function addTaskFields($userTask,$projectName,$labelName)
    {
        $tasks = [];
        foreach ($userTask as $task) {

            $newObject = new stdClass();

            transformTaskModel($newObject,$task,$projectName,$labelName);

            array_push($tasks, $newObject);
        }

        return $tasks;
    }
     function getProjectByProjectId($projectId)
    {
        return project::where('id', $projectId)->first();
    }
    function getLabelByLabelId($labelId)
    {
        return label::where('id', $labelId)->first();
    }
     function transformTaskModel($newObject,$task,$projectName,$labelName)
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
            $project = getProjectByProjectId($task->project_id);
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
            $label = getLabelByLabelId($task->label_id);
            if($label!=null)
            {
            $newObject->labelName = $label->label_name;
            }
        }
        return($newObject);
    }
    function todaydate()
    {
        return Carbon::today()->format('D d M');
    }
    function duedate($date)
    {
        $date->transform(function ($task) {
            if($task->due_date!=null)
            $task->due_date = Carbon::parse($task->due_date)->format('D d M');
            return $task;
        });
    }



}

