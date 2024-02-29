<?php

use App\Models\label;
use App\Models\project;
use App\Models\task;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\CustomModels\TaskData;
function getUserByEmail($email)
{
    return User::where('email', $email)->first();
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

function getCount($tasks)
{
    $completedTasksCount = $tasks->filter(function ($task) {
        return $task->completed == 1 ;
    });

    $todayTasksCount = $tasks->filter(function ($task) {
        return  Carbon::parse($task->due_date)==Carbon::today() && $task->completed==0;
    });

    $overdueTasksCount = $tasks->filter(function ($task) {
        return Carbon::parse($task->due_date)>Carbon::today() && $task->completed==0;
    });

    return [
        'completedTasksCount' => $completedTasksCount,
        'todayTasksCount' => $todayTasksCount,
        'overdueTasksCount' => $overdueTasksCount,
    ];

}
function getTasksByProjectId($userId,$project_id)
{
    $tasks=getTasks($userId);

    $filteredTasks = $tasks->filter(function ($task) use ($project_id) {
        return $task->project_id == $project_id;
    });

    return $filteredTasks;
}
function getTasksByLabelId($userId,$label_id)
{
    $tasks=getTasks($userId);

    $filteredTasks = $tasks->filter(function ($task) use ($label_id) {
        return $task->label_id == $label_id;
    });
    return $filteredTasks;
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
    $tasks=getTasks($userId);

    return $tasks->filter(function($task)
    {
        return Carbon::parse($task->due_date)==Carbon::today() && $task->completed==0;
    });
}
function getTasksWithinDateRange($userId, $startDate, $endDate)
{
    $tasks = getTasks($userId);

    return $tasks->filter(function ($task) use ($startDate, $endDate) {
        $dueDateWithinRange = Carbon::parse($task->due_date)->between($startDate, $endDate);
        $taskDurationWithinRange = Carbon::parse($task->start_date)->greaterThanOrEqualTo($startDate) &&
                                   Carbon::parse($task->end_date)->lessThanOrEqualTo($endDate);

        return ($dueDateWithinRange || $taskDurationWithinRange) && !$task->completed;
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

// function getProjectByProjectId($projectId)
// {
//     return project::where('id', $projectId)->first();
// }
// function getLabelByLabelId($labelId)
// {
//     return label::where('id', $labelId)->first();
// }

// function todaydate()
// {
//     return Carbon::today()->format('D d M');
// }
function getFormetedDuedate($date)
{
    $date->transform(function ($task) {
        if ($task->due_date != null)
            $task->due_date = Carbon::parse($task->due_date)->format('D, M j');
        return $task;
    });
}


