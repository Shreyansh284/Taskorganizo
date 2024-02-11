<div >

    <div class="col-md-5 mx-auto">
            <input wire:model.live.debounce="getTasks" class="form-control shadow border border-0 " type="search" placeholder="Search"
                >
    </div>


            <div class="row mt-5 pt-3 px-2">
                @foreach ($tasks as $task)
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                    <div class="card  mb-3 shadow border border-0" >
                        <div class="card-body " >
                            <div class="mb-2">
                                <form action="">
                                    <input wire:click="toggle({{$task->id}})"  class="form-check-input" priority="{{$task->priority}}"  type="checkbox" >
                                </form>
                            </div>
                            <div>
                            <h5 class="card-title">{{ $task->task_name }}</h5>
                            <p class="card-text">{{ $task->task_description }}</p>
                             </div>
                        <div class="dropdown" >
                            <a style="text-decoration: none ;"  data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots "></i>
                            </a>
                            <ul class="dropdown-menu shadow border border-0">
                              <a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#editProject{{$task->id}}">Edit</a>
                              <a class="dropdown-item" wire:click="deleteTask({{$task->id}})" >Delete</a>
                            </ul>
                          </div>
                     </div>


                    <div
                        class="card-footer   border-danger-subtle">
                        @if(isset($task->due_date ))
                        <span class="badge date "  >! {{ $task->due_date }}</span>
                           @endif
                        @if(isset($task->projectName ))
                        <a wire:navigate href="{{ URL::to('/') }}/project/{{ $task->projectName }}">

                            <span class="badge project" ># {{ $task->projectName }}</span>
                        </a>
                           @endif
                        @if(isset($task->labelName ))
                        <a href="{{ URL::to('/') }}/label/{{ $task->labelName }}">

                        <span class="badge label" >@ {{ $task->labelName }}</span>
                        </a>
                           @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div ><a data-bs-toggle="modal" data-bs-target="#addTask"  class="ms-2 fw-semibold" style="font-size: 15px;  color:brown" ><i
        style="font-size: 25px; color:brown" class="bi bi-plus-circle-fill mr-2"></i> Add Task </a>
    </div>

</div>
