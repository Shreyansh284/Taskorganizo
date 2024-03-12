<?php
use App\Livewire\CalenderView;
use App\Livewire\Chart;
use App\Livewire\CompletedTasks;
use App\Livewire\Labels;
use App\Livewire\GetTasksByLabelId;
use App\Livewire\GetTasksByProjectId;
use App\Livewire\MyTeams;
use App\Livewire\Profile;
use App\Livewire\Statistics;
use App\Livewire\TaskAndMemberOfTeam;
use App\Livewire\Team;
use App\Livewire\Teams;
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
use App\Helpers\TeamHelper;

Route::get('/', function () {

    return view('welcome');
});
Route::view('register', 'register');
Route::view('registerByTeamInvite', 'register');
Route::post('loginAuth', [logincontroller::class, 'loginAuth']);
Route::view('login', 'login');

Route::post('users', [usercontroller::class, 'addUser']);
Route::get('join', [usercontroller::class, 'redirectToUserToJoin']);
Route::post('addUserByTeamInvite', [usercontroller::class, 'addUserByTeamInvite']);
Route::get('user/{user_id}/team/{team_id}',[usercontroller::class,'joinExistingUserInTeam']);

Route::view('forgetPassword', 'forgetPassword');
Route::post('forgetPasswordForm', [usercontroller::class, 'forgetPassword']);
Route::get('resetPasswordForm', [usercontroller::class, 'resetPassword']);
Route::post('resetPassword', [usercontroller::class, 'resetPasswordPost']);

Route::middleware(['login'])->group(function () {

    Route::get('inbox', Inbox::class);
    Route::get('today', TodayTasks::class);
    Route::get('calender-view', CalenderView::class);
    Route::get('labels', Labels::class);
    Route::get('projects', Projects::class);
    Route::get('completed', CompletedTasks::class);
    Route::get('teams', Teams::class);
    Route::get('statistics', Statistics::class);
    Route::get('myProfile', Profile::class);
    Route::get('tasks/project/{project_id}', GetTasksByProjectId::class);
    Route::get('tasks/label/{label_id}', GetTasksByLabelId::class);
    Route::get('team/{team_id}/taskAndUsers', TaskAndMemberOfTeam::class);

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

Route::get('user/{id}/addteam',[usercontroller::class,'addteam']);
