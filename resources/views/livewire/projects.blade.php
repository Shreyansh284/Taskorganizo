<div class="px-3">
    <div class="table-data ">
        <div class="todo">
            <div class="justify-content-between head ms-3 p-2">
                <h3>Projects</h3>
                <a data-bs-toggle="modal" data-bs-target="#addProject"  > <strong><i class='bi bi-plus-circle-fill fontbrown '
                            ></strong></i></a>
            </div>
            <div style="height:75vh;overflow:auto">
                <br>
                <ul class="todo-list ">
                    @if ($projects != '[]')
                        @foreach ($projects as $project)
                            <li class="high shadow">
                                <a wire:navigate href="{{ URL::to('/') }}/project/{{ $project->project_name }}"
                                    style="color:rgb(76, 76, 76) "> <strong>{{ $project->project_name }}</strong> </a>
                                    <div class="dropdown">
                                        <a  data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots  "></i>
                                        </a>
                                        <ul class="dropdown-menu shadow border border-0">
                                        <a class="dropdown-item " data-bs-toggle="modal" data-bs-target="#editProject"  wire:click="editProject({{$project->id}})" >Edit  </a>
                                        <a class="dropdown-item" wire:click="deleteProject({{$project->id}})" >Delete</a>
                                        </ul>
                                    </div>
                            </li>

                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="editProject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="">Edit Project</h1>
                    <button type="button" class="btn-close"data-bs-dismiss="modal" wire:click="clear" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="updateProject" >
                        <div class="form-group">
                            <input wire:model="edit_project_name" type="text" class="form-control"
                                >
                            <span>
                                @error('edit_project_name')
                                    {{ $message     }}
                                @enderror
                            </span>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"  wire:click="clear"  data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn color" >Edit</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </div>

    <div wire:ignore.self class="modal fade" id="addProject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="">Add Project</h1>
                    <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addProject" >
                        <div class="form-group">
                            <input wire:model="project_name" type="text" class="form-control" id="recipient-name "
                                placeholder="Project Name" >
                            <span>
                                @error('project_name')
                                    {{ $message     }}
                                @enderror
                            </span>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn color" wire:click="$dispatch('closeProjectModal')" >Add Project</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </div>

</div>

