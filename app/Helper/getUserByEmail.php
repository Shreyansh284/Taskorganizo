<?php

use App\Models\label;
use App\Models\project;
use App\Models\task;
use Illuminate\Support\Carbon;
use App\CustomModels\TaskData;


function getUserByEmail($email)
{
    return \App\Models\User::where('email', $email)->first();
}



function getUpdatedTasks($tasks)
{

    $updatedTasks=[];
    foreach($tasks as $task){
        $taskData = new TaskData();
        $taskData->id = $task['id'];
        $taskData->task_name = $task['task_name'];
        $taskData->task_description = $task['task_description'];
        $taskData->project_id = $task['project_id'];
        $taskData->project_name = $task['project_name'];
        $taskData->label_id = $task['label_id'];
        $taskData->label_name = $task['label_name'];
        $taskData->due_date = $task['due_date'];
        $taskData->completed = $task['completed'];
        $taskData->priority = $task['priority'];
        $updatedTasks[]=$taskData;
    }
    return $updatedTasks;

}


function getTasks($userId)
{
    return task::select('tasks.*','projects.project_name', 'labels.label_name')
    ->where('tasks.user_id', $userId)
    ->leftJoin('labels', 'tasks.label_id', '=', 'labels.id')
    ->leftJoin('projects', 'tasks.project_id', '=', 'projects.id')
    ->latest()
    ->get();

}
function getNotCompletedTasks($userId)
{
    $tasks=getTasks($userId);
    return $tasks->filter(function ($task)
    {
        return $task->completed == 0;
    });
}

function getTasksWhereDueDateIsToday($userId)
{
    $tasks=getNotCompletedTasks($userId);
    return $tasks->filter(function($task)
    {
        return Carbon::parse($task->due_date)==Carbon::today();
    });
}

function getCompletedTasks($userId)
{
    $tasks=getTasks($userId);
    return $tasks->filter(function ($task)
    {
        return $task->completed == 1;
    });
}

function getProjectByProjectId($projectId)
{
    return project::where('id', $projectId)->first();
}
function getLabelByLabelId($labelId)
{
    return label::where('id', $labelId)->first();
}

function todaydate()
{
    return Carbon::today()->format('D d M');
}
function getFormetedDuedate($date)
{
    $date->transform(function ($task) {
        if ($task->due_date != null)
            $task->due_date = Carbon::parse($task->due_date)->format('D d M');
        return $task;
    });
}


