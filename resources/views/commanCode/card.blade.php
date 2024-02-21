    <div class="card shadow border border-0 p-3">
        <div class="border-0 d-flex justify-content-between">
            <input type="checkbox" {{ $task->completed==1 ? 'checked' : '' }} wire:click="toggleTaskStatus({{ $task->id }})"
                class="form-check-input" priority="{{ $task->priority }}">
            <div class="dropdown">
                <a style="text-decoration: none;" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots"></i>
                </a>
                <ul class="dropdown-menu shadow border border-0">
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editTask"
                         wire:click="editTask({{ $task->id }})">Edit</a>
                    <a class="dropdown-item" wire:click="deleteTask({{ $task->id }})">Delete</a>
                </ul>
            </div>
        </div>
        <div class="d-flex flex-column mt-3 mb-3">
            <h5 class="card-title">
                {{ $task->task_name }}
            </h5>
            <p class="card-text">{{ $task->task_description }}</p>
        </div>
        <div class="d-flex flex-wrap pt-2" style="border-top:double  rgb(165, 42, 42)">
            @if (isset($task->due_date))
            <a href="">
                <span class="badge date me-1">! {{ $task->due_date }}</span>
            </a>
            @endif
            @if (isset($task->project_name))
                <a wire:click="getTasksByProject({{$task->project_name}})">
                    <span class="badge project me-1"># {{ $task->project_name }}</span>
                </a>
            @endif
            @if (isset($task->label_name))
                <a href="{{ URL::to('/') }}/label/{{ $task->label_name }}">
                    <span class="badge label me-1">@ {{ $task->label_name }}</span>
                </a>
            @endif
        </div>
    </div>



