<?php

use App\Http\Controllers\labelcontroller;
use App\Http\Controllers\projectcontroller;
use App\Http\Controllers\taskcontroller;
use App\Http\Controllers\usercontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


///////////         USERS            //////////

Route::get('users',[usercontroller::class, 'getAllUsers']);
Route::get('users/{id}',[usercontroller::class, 'getUserById']);
Route::post('users',[usercontroller::class, 'addUser']);
Route::put('users/{id}',[usercontroller::class, 'updateUser']);
Route::delete('users/{id}',[usercontroller::class, 'deleteUser']);


////////////       TASKS              /////////


// Route::get('tasks/{id}',[taskcontroller::class, 'getTaskById']);
// Route::get('users/{user_id}/tasks',[taskcontroller::class, 'getTasksByUserId']);
Route::get('users/{user_id}/tasks/priority/{priority}',[taskcontroller::class, 'getUserTasksByPriority']);
Route::get('users/{user_id}/tasks/dueDate/{due_date}',[taskcontroller::class, 'getUserTasksByDueDate']);
Route::get('users/{user_id}/tasks/projects/{project_id}',[taskcontroller::class, 'getUserTasksByProjects']);
Route::get('users/{user_id}/tasks/labels/{label_id}',[taskcontroller::class, 'getUserTasksByLabels']);
Route::post('tasks',[taskcontroller::class, 'addTask']);
Route::put('/users/{user_id}/tasks/{id}',[taskcontroller::class, 'updateTask']);
Route::delete('/users/{user_id}/tasks/{id}',[taskcontroller::class, 'deleteTask']);

////////////       PROJECTS              /////////


// Route::get('users/{email}/projects/',[projectcontroller::class, 'getUserProjectsByUserId']);
// Route::post('projects',[projectcontroller::class, 'addProject']);
Route::put('users/{user_id}/projects/{project_id}',[projectcontroller::class, 'updateProject']);
Route::delete('users/{user_id}/projects/{project_id}/',[projectcontroller::class, 'deleteProject']);


////////////       LABEL              /////////

// Route::get('users/{email}/labels/',[labelcontroller::class, 'getUserLabelsByUserId']);
Route::post('labels',[labelcontroller::class, 'addLabel']);
Route::put('users/{user_id}/labels/{label_id}',[labelcontroller::class, 'updateLabel']);
Route::delete('users/{user_id}/labels/{label_id}/',[labelcontroller::class, 'deleteLabel']);

