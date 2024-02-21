<!-- livewire/upcoming-tasks.blade.php -->

<div>
    <h5 class="card-title mt-3 ms-2 fontbrown" ><strong>Upcoming Tasks:</strong></h5>

    <div class="row mt-3 pt-3 px-2  flex-nowrap">
        @foreach ($dates as $date)
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                <h6 class="card-title mb-2 fontbrown ms-2 m" >{{ $date->format('D, M j') }}</h6>
                @if ($datesWithTasks->has($date->format('Y-m-d')))
                @foreach ($datesWithTasks[$date->format('Y-m-d')] as $task)
                <div class="card mb-3 shadow border border-0">
                    <div class="card-body">


                                        <div class="mb-2">
                                            <form action="">
                                                <input wire:click="toggle({{$task->id}})" class="form-check-input" priority="{{$task->priority}}" type="checkbox">
                                            </form>
                                        </div>
                                        <div>
                                            <h5 class="card-title">{{ $task->task_name }}</h5>
                                            <p class="card-text">{{ $task->task_description }}</p>
                                        </div>
                                        <div class="dropdown">
                                            <a style="text-decoration: none;" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </a>
                                            <ul class="dropdown-menu shadow border border-0">
                                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editProject{{$task->id}}">Edit</a></li>
                                                <li><a class="dropdown-item" wire:click="deleteTask({{$task->id}})">Delete</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
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
                        @endforeach
                        @else
                        <div class="card shadow border border-0">
                            <div class="card-body fontbrown ">
                                <strong >!! Task Not Found !!</strong>
                            </div>
                        </div>

                        @endif
            </div>
        @endforeach
    </div>
</div>
