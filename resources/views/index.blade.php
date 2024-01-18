@extends('master')
@section('link')

<div class="row"><a data-toggle="modal" data-target="#addlabel"  style="text-decoration: none"><button type="button"   data-toggle="modal" data-target="#addtask" class="btn btn-danger  rounded-circle  btn-sm"  style="width: 32px ;height:32px; "> <strong><i class='bx bx-plus'  style="font-size:20px; margin-left:-3px " ></strong></i></button> </a>
</div>
<br>
<?php
$tasks=App\Http\Controllers\taskcontroller::getTasksByEmail($email=session()->get('email'));
?>
<div class="row" >
        @foreach ($tasks as $task)
        <div class="col-xl-3 mb-4" >
          <div class=" card border border-3 border">
            <div class="card-body text">
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">

                  <div class="ms-3">
                    <p class="fw-bold mb-1">{{$task->task_name}}</p>
                    <p class=""> {{$task->task_description}}</p>
                    <div style="display:flex" >
                        <p class="badge badge-light" style="color: rgb(17, 16, 16)" >{{$task->due_date}}</p>
                       @if (isset($task->labelName))
                       &nbsp;<p class="badge badge-dark">{{$task->labelName}}</p>
                       @endif
                    </div>
                </div>
            </div>
            <div class="dropdown">
                <a style="text-decoration: none" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                        <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                      </svg><i class="bi bi-three-dots"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <a class="dropdown-item" >Edit</a>
                    <a href=""class="dropdown-item" >Delete</a>
                </div>
              </div>

            </div>
            </div>
            <div class="card-footer  bg-warning opacity-50 p-2 d-flex justify-content-around">
            {{$task->priority}}
            </div>
        </div>
    </div>

    @endforeach
    </div>
@endsection
