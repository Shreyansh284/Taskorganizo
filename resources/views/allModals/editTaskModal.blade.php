<div wire:ignore.self class="modal fade" id="editTask" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="">Edit Task</h1>
                <button type="button" class="btn-close" wire:click="clear" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="updateTask">
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
                    <div class="form-group row">
                        <div class="col-md-6 col-sm-6 col-6">
                            <div wire:model="edit_priority" class="form-group">
                                <select class="form-select" aria-label="Default select example" name="priority">
                                    <option value="low">Choose Priority</option>
                                    <option value="low" @if ($edit_priority == 'low') selected @endif
                                        name="priority">Low
                                    </option>
                                    <option value="medium" @if ($edit_priority == 'medium') selected @endif
                                        name="priority">
                                        Medium</option>
                                    <option value="high" @if ($edit_priority == 'high') selected @endif
                                        name="priority">
                                        High</option>

                                </select>
                                <span>
                                    @error('priority')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <input wire:model="edit_due_date" type="date" class="form-control"
                                    id="recipient-name" name="due_date" placeholder="Due Date"
                                    min="{{ now()->format('Y-m-d') }}">
                                <span>
                                    @error('due_date')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                    <div wire:model="edit_projectId" class="form-group">
                        <select class="form-select" aria-label="Default select example" name="projectName">
                            <option value="{{ null }}">Add Project</option>
                            @if ($projects != '[]')
                                @foreach ($projects as $projectId => $projectName)
                                    <option value="{{ $projectId }}"
                                        @if ($edit_projectId == $projectId) selected @endif> {{ $projectName }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <span>
                            @error('edit_projectId')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <select class="form-select" aria-label="Default select example" wire:model="edit_labelId">
                            <option value="{{ null }}">Add Label</option>
                            @if ($labels != '[]')
                                @foreach ($labels as $labelId => $labelName)
                                    <option value="{{ $labelId }}"
                                        @if ($edit_labelId == $labelId) selected @endif>{{ $labelName }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <span>
                            @error('edit_labelId')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <select class="form-select" aria-label="Default select example" wire:model="edit_teamId">
                            <option value="{{ null }}">Add Team</option>
                            @if ($teams != '[]')
                                @foreach ($teams as $teamId => $teamName)
                                    <option value="{{ $teamId }}"
                                        @if ($edit_teamId == $teamId) selected @endif>{{ $teamName }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <span>
                            @error('edit_teamId')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="clear"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Edit Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
