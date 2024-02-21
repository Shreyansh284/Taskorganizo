<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $tasks = [];
        for ($i = 33; $i <=44 ; $i++)
        {
            if($i%2==0)
            {
                $p='high';
            }
            elseif($i%3==0)
            {
                $p='medium';
            }
            else{
                $p='low';
            }
            $tasks[] =
            [
                'user_id'=>'3',
                'project_id'=>'1',
                'label_id'=>'1',
                'task_name'=>'Task'.$i,
                'task_description'=>'Taskdescription',
                'due_date'=>Carbon::today(),
                'priority'=>$p

            ];
        }
        DB::table('tasks')->insert($tasks);
    }
}
