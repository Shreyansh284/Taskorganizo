<div>
    <div wire:ignore.self class="modal fade" id="addTask" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="">Add Task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" wire:submit="addTask">
                        @csrf
                        <div class="form-group">
                            <input wire:model.live="task_name" type="text" class="form-control" id="recipient-name "
                                placeholder="Task Name" required>
                            <span>
                                @error('task_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">

                            <textarea wire:model.live="task_description" class="form-control" id="message-text" name="task_description"
                                placeholder="Task Description"></textarea>
                            <span>
                                @error('task_description')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">

                            <input wire:model.live="due_date" type="date" class="form-control" id="recipient-name"
                                name="due_date" placeholder="Due Date" min="{{ now()->format('Y-m-d') }}">
                            <span>
                                @error('due_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div wire:model.live="projectId" class="form-group">
                            <select class="form-select" aria-label="Default select example" name="projectName">
                                <option value="{{ null }}">Choose Project</option>
                                @if ($projects != '[]')
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">
                                            {{ $project->project_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span>
                                @error('projectName')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div wire:model.live="labelId" class="form-group">
                            <select class="form-select" aria-label="Default select example" name="labelName">
                                <option value="{{ null }}">Choose Label</option>
                                @if ($labels != '[]')
                                    @foreach ($labels as $label)
                                        <option value="{{ $label->id }}">{{ $label->label_name }}
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
                        <div wire:model.live="priority" class="form-group">
                            <select class="form-select" aria-label="Default select example" name="priority">
                                <option value="low">Choose Priority</option>
                                <option value="low"name="priority">Low</option>
                                <option value="medium"name="priority">Medium</option>
                                <option value="high"name="priority">High</option>
                            </select>
                            <span>
                                @error('priority')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn color">Add Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
