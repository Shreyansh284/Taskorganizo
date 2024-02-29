<?php
use App\Livewire\CalenderView;
use App\Livewire\CompletedTasks;
use App\Livewire\Labels;
use App\Livewire\GetTasksByLabelId;
use App\Livewire\GetTasksByProjectId;
use App\Livewire\Profile;
use App\Livewire\Team;
use App\Livewire\TodayTasks;
use Livewire\Livewire;
use App\Http\Controllers\labelcontroller;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\projectcontroller;
use App\Http\Controllers\taskcontroller;
use App\Http\Controllers\usercontroller;
use App\Livewire\Inbox;
use App\Livewire\Projects;
use Illuminate\Support\Facades\Route;
use function Termwind\render;

Route::get('/', function () {

    return view('welcome');
});
Route::view('register', 'register');
Route::view('login', 'login');
Route::post('loginAuth', [logincontroller::class, 'loginAuth']);
Route::post('users', [usercontroller::class, 'addUser']);


Route::middleware(['login'])->group(function () {

    Route::get('inbox', Inbox::class);
    Route::get('today', TodayTasks::class);
    Route::get('calender-view', CalenderView::class);
    Route::get('labels', Labels::class);
    Route::get('projects', Projects::class);
    Route::get('completed', CompletedTasks::class);
    Route::get('team', Team::class);
    Route::get('myProfile', Profile::class);
    Route::get('tasks/project/{project_id}', GetTasksByProjectId::class);
    Route::get('tasks/label/{label_id}', GetTasksByLabelId::class);

    // Route::get('users/{email}/tasks',[taskcontroller::class, 'getTasksByEmail']);
    // Route::get('filter/priority/{priority}',[taskcontroller::class, 'getTasksByPriority']);
    // Route::get('project/{project_name}',[taskcontroller::class, 'getTasksByProjects']);
    // Route::get('label/{label_name}',[taskcontroller::class, 'getTasksByLabels']);
    // Route::post('labels',[labelcontroller::class, 'addLabel']);
    // Route::post('tasks',[taskcontroller::class, 'addTask']);

    // Route::get('users/{email}/labels',[labelcontroller::class, 'getLabelsByUserEmail']);
    // Route::get('users/{email}/projects/',[projectcontroller::class, 'geProjectsByUserEmail']);

    // Route::view('master','master');
    Route::get('logout', [logincontroller::class, 'logout']);
    // Route::post('projects',[projectcontroller::class, 'addProject']);
});
