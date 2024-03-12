    <div class="card shadow border border-0 p-3">

        <div class="border-0 d-flex justify-content-between">

            <input type="checkbox" wire:key="task-{{ $task->id }}" {{ $task->completed == 1 ? 'checked' : '' }}
                wire:click="toggleTaskStatus({{ $task->id }})" class="form-check-input cursor"
                priority="{{ $task->priority }}" {{$task->user_id!==$user_id? 'disabled':''}}  >

                <div class="dropdown">
                    @if($task->user_id == $user_id)
                        <a style="text-decoration: none;" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi iconColor bi-three-dots"></i>
                        </a>
                        <ul wire:ignore.self class="dropdown-menu shadow border border-0">
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editTask"
                                wire:click="editTask({{ $task->id }})">Edit</a>
                            <a class="dropdown-item"  wire:click="deleteTask({{ $task->id }})"  wire:confirm="Are you sure you want to delete this post?" >Delete</a>
                        </ul>
                    @else
                        <i class="bi iconColor bi-three-dots notallowed"></i>
                    @endif
                </div>
        </div>
        <div class="d-flex flex-column mt-3 mb-3">
            <h5 class="card-title">
                {{ $task->task_name }}
            </h5>
            <p class="card-text">{{ $task->task_description }}</p>
        </div>
        <div class="d-flex flex-wrap pt-2" style="border-top:dashed 1px  rgb(165, 42, 42)">
            @if (isset($task->due_date))
                <a>
                    <span class="badge date me-1 text-center"><i class="bi pe-1 bi-calendar4-event"></i> {{ $task->due_date }}</span>
                </a>
            @endif
            @if (isset($task->project_name))
                <a wire:navigate href="{{ URL::to('/') }}/tasks/project/{{ $task->project_id }}">
                    <span class="badge project me-1"><i class=" me-1 bi bi-view-list"></i> {{ $task->project_name }} </span>
                </a>
            @endif
            @if (isset($task->label_name))
                <a wire:navigate href="{{ URL::to('/') }}/tasks/label/{{ $task->label_id }}">
                    <span class="badge label "><i class="bi me-1 bi-tags"></i>{{ $task->label_name }}</span>
                </a>
            @endif
        </div>
    </div>
