<div >
    <div class="table-data ">
        <div class="todo">
            <div class="justify-content-between head ms-3 p-2">
                <h3>Projects</h3>
                <a data-bs-toggle="modal" data-bs-target="#addProject"  > <strong><i class='bi bi-plus-circle-fill'
                            style="color: brown"></strong></i></a>
            </div>
            <div>
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
                                        <a class="dropdown-item " data-bs-toggle="modal" href="#editProject{{$project->id}}" >Edit  </a>
                                        <a class="dropdown-item" wire:click="deleteProject({{$project->id}})" >Delete</a>
                                        </ul>
                                    </div>
                            </li>
                            <div wire:ignore.self class="modal fade" id="editProject{{$project->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="">Edit Project</h1>
                                            <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form wire:submit="editProject({{$project->id}})" >
                                                <div class="form-group">
                                                    <input wire:modal="edit_project_name" type="text" class="form-control"
                                                        value="{{$project->project_name}}"  required>
                                                    <span>
                                                        @error('project_name')
                                                            {{ $message     }}
                                                        @enderror
                                                    </span>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger" >Edit</button>
                                                    <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="addProject" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="">Add Project</h1>
                    <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="addProject" >
                        <div class="form-group">
                            <input wire:model="project_name" type="text" class="form-control" id="recipient-name "
                                placeholder="Project Name" required>
                            <span>
                                @error('project_name')
                                    {{ $message     }}
                                @enderror
                            </span>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" >Add Project</button>
                            <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </div>

</div>
    <script data-navigate-once >
        document.addEventListener('livewire:initialized',()=>{
            @this.on('closeProjectModal',(event)=>{

                var mymodal=document.querySelector('#addProject')
                var modal=bootstrap.Modal.getOrCreateInstance(mymodal)
                modal.hide();
            })
        })
    </script>
