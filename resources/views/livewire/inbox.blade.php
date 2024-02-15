<div>

    @include('commanCode.search')


    <div class="row mt-3 px-2">
        <div class="col-md-3 mt-2 ">
            <select wire:model.live="priorityFilter" class="form-select shadow border border-0 ">
                <option value="">Priority</option>
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select>
        </div>

        <div class="col-md-3 mt-2">
            <select wire:model.live="labelFilter" class="form-select shadow border border-0 ">
                <option value="">Label</option>
                @foreach ($labels as $labelId => $labelName)
                    <option value="{{ $labelId }}">{{ $labelName }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 mt-2">
            <select wire:model.live="projectFilter" class="form-select shadow border border-0 ">
                <option value="">Project</option>
                @foreach ($projects as $projectId => $projectName)
                    <option value="{{ $projectId }}">{{ $projectName }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 mt-2">
            <input wire:model.live="dueDateFilter" class="form-control shadow border border-0" type="date"
                placeholder="Due Date">
        </div>
    </div>

    <div class="row mt-5 pt-3 px-2">
        @forelse($tasks as $task)
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-3">
                @include('commanCode.card',['task'=>$task])
            </div>
        @empty
        <div class="col-md-3">
            <div class="card shadow border border-0">
                <div class="card-body  ">
                    <strong style="color: brown">!! Task Not Found !!</strong>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <div><a data-bs-toggle="modal" data-bs-target="#addTask" class="ms-2 fw-semibold"
            style="font-size: 15px;  color:brown"><i style="font-size: 25px; color:brown"
                class="bi bi-plus-circle-fill mr-2"></i> Add Task </a>
    </div>
    <div wire:ignore.self class="modal fade" id="editTask" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="">Edit Task</h1>
                    <button type="button" class="btn-close" wire:click="clear"  data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form  wire:submit="updateTask">
                        @csrf
                        <div class="form-group">
                            <input wire:model="edit_task_name" type="text" class="form-control" id="recipient-name "
                                placeholder="Task Name" required>
                            <span>
                                @error('edit_task_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">

                            <textarea wire:model="edit_task_description" class="form-control" id="message-text" name="task_description"
                                placeholder="Task Description"></textarea>
                            <span>
                                @error('task_description')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">

                            <input wire:model="edit_due_date" type="date" class="form-control" id="recipient-name"
                                name="due_date" placeholder="Due Date">
                            <span>
                                @error('due_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div wire:model="edit_projectId" class="form-group">
                            <select class="form-select" aria-label="Default select example" name="projectName">
                                <option value="{{ null }}">Choose Project</option>
                                @if ($projects != '[]')
                                    @foreach ($projects as $projectId => $projectName)
                                        <option value="{{ $projectId }}"
                                            @if ($edit_projectId == $projectId) selected @endif>{{ $projectName }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>

                            <span>
                                @error('projectName')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <select class="form-select" aria-label="Default select example"
                                wire:model="edit_labelId">
                                <option value="{{ null }}">Choose Label</option>
                                @if ($labels != '[]')
                                    @foreach ($labels as $labelId => $labelName)
                                        <option value="{{ $labelId }}"
                                            @if ($edit_labelId == $labelId) selected @endif>{{ $labelName }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <span>
                                @error('label')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div wire:model="edit_priority" class="form-group">
                            <select class="form-select" aria-label="Default select example" name="priority">
                                <option value="low">Choose Priority</option>
                                <option value="low" @if ($edit_priority == 'low') selected @endif name="priority">Low</option>
                                <option value="medium" @if ($edit_priority == 'medium') selected @endif name="priority">Medium</option>
                                <option value="high" @if ($edit_priority == 'high') selected @endif name="priority">High</option>
                            </select>
                            <span>
                                @error('priority')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>



                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="clear" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Edit Task</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>



    </div>

</div>
