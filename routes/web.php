<?php

use App\Http\Controllers\labelcontroller;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\projectcontroller;
use App\Http\Controllers\taskcontroller;
use App\Http\Controllers\usercontroller;
use App\Livewire\Inbox;
use App\Livewire\Projects;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::view('register','register');
Route::view('login','login');

// Route::get('index',Inbox::class);

Route::post('loginAuth',[logincontroller::class, 'loginAuth']);
Route::post('users',[usercontroller::class, 'addUser']);


Route::middleware(['login'])->group(function () {

    Route::view('index','index');
    Route::view('today','today');
    Route::view('upcoming','upcoming');
    Route::view('filterAndLabel','filterAndLabel');
    Route::view('project','project');
    Route::view('completed','completed');
    // Route::get('project',[Projects::class]);
    Route::view('master','master');

    Route::view('second', 'second');
    Route::view('extended-dropdown', 'extended-dropdown');



    Route::get('users/{email}/tasks',[taskcontroller::class, 'getTasksByEmail']);
    Route::get('filter/priority/{priority}',[taskcontroller::class, 'getTasksByPriority']);
    Route::get('project/{project_name}',[taskcontroller::class, 'getTasksByProjects']);
    Route::get('label/{label_name}',[taskcontroller::class, 'getTasksByLabels']);
    Route::post('labels',[labelcontroller::class, 'addLabel']);
    Route::post('tasks',[taskcontroller::class, 'addTask']);

    Route::get('users/{email}/labels',[labelcontroller::class, 'getLabelsByUserEmail']);
    Route::get('users/{email}/projects/',[projectcontroller::class, 'geProjectsByUserEmail']);

    // Route::view('master','master');
    Route::get('logout',[logincontroller::class, 'logout']);
    Route::post('projects',[projectcontroller::class, 'addProject']);

});
