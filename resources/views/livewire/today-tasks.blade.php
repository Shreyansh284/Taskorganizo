<div >

    <div class="col-md-5 mx-auto">
            <input wire:model.live.debounce="getTasks" class="form-control shadow border border-0 " type="search" placeholder="Search"
                >
    </div>


    <h5 class="card-title mt-5 ms-2" style="color: brown"><strong>Today :</strong> {{$date}}</h5>

            <div class="row mt-3  pt-3 px-2">

                @foreach ($todayTasks as $todayTask)
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                    <div class="card  mb-3 shadow border border-0" >
                        <div class="card-body " >
                            <div class="mb-2">
                                <form action="">
                                    <input wire:click="toggle({{$todayTask->id}})"  class="form-check-input" priority="{{$todayTask->priority}}"  type="checkbox" >
                                </form>
                            </div>
                            <div>
                            <h5 class="card-title">{{ $todayTask->task_name }}</h5>
                            <p class="card-text">{{ $todayTask->task_description }}</p>
                             </div>
                        <div class="dropdown" >
                            <a style="text-decoration: none ;"  data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots "></i>
                            </a>
                            <ul class="dropdown-menu shadow border border-0">
                              <a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#editProject{{$todayTask->id}}">Edit</a>
                              <a class="dropdown-item" wire:click="deleteTask({{$todayTask->id}})" >Delete</a>
                            </ul>
                          </div>
                     </div>


                    <div
                        class="card-footer   border-danger-subtle">
                        @if(isset($todayTask->due_date ))
                        <span class="badge date" > ! {{ $todayTask->due_date }}</span>
                           @endif
                        @if(isset($todayTask->projectName ))
                        <span class="badge project"># {{ $todayTask->projectName }}</span>
                           @endif
                        @if(isset($todayTask->labelName ))
                        <span class="badge label"  >@ {{ $todayTask->labelName }}</span>
                           @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div ><a data-bs-toggle="modal" data-bs-target="#addTask"  class="card-title  fw-semibold ms-2" style="font-size: 15px;  color:brown" ><i
        style="font-size: 25px; color:brown" class="bi bi-plus-circle-fill mr-2"></i> Add Task </a>
    </div>

</div>
