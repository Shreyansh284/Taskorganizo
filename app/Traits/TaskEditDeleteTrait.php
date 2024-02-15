<?php
namespace App\Traits;
use App\Models\task;

trait TaskEditDeleteTrait
{
    public function deleteTask($id)
    {
        task::where('id', $id)->delete();
    }

    public function toggleTaskStatus($id)
    {
        $task = task::where('id', $id)->first();

        if ($task) {
            $task->completed = !$task->completed;
            $task->save();
        }
    }

    
}
