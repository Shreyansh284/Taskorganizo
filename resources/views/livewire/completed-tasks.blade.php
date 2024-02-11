<div >
    <h5 class="card-title mt-3 ms-2" style="color: brown"><strong>Completed Tasks :</strong></h5>
    <div class="row mt-3 pt-3 px-2">

                @foreach ($tasks as $task)
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                    <div class="card  mb-3 shadow border border-0" >
                        <div class="card-body " >
                            <div class="mb-2">
                                <form action="">
                                    <input wire:click="toggle({{$task->id}})" class="form-check-input" priority="{{$task->priority}}"  type="checkbox" checked>
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

                              <a class="dropdown-item" wire:click="deleteTask({{$task->id}})" >Delete</a>
                            </ul>
                          </div>
                     </div>


                    <div
                        class="card-footer   border-danger-subtle">
                        @if(isset($task->due_date ))
                        <span class="badge date " >! {{ $task->due_date }}</span>
                           @endif
                        @if(isset($task->projectName ))
                        <span class="badge project"># {{ $task->projectName }}</span>
                           @endif
                        @if(isset($task->labelName ))
                        <span class="badge label">@ {{ $task->labelName }}</span>
                           @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
