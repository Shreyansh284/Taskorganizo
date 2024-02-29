<div>
    <div class="d-flex justify-content-between mt-2">
        <h5 class="card-title ms-4 fontbrown mt-2 "><strong class="me-2">Projects</strong></h5>
        <button data-bs-toggle="modal" data-bs-target="#addProject" class="btn color"> + Add Project</button>
    </div>
    <div class="row mt-4 ms-3 pt-3 customproject ">
        @forelse($projects as $project)
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-3">
                <div class="card  shadow border boder-0 p-3">

                    <div class="d-flex justify-content-between">
                        <h6 class="card-title ">
                            <a  class="text-dark"  wire:navigate href="{{ URL::to('/') }}/tasks/project/{{ $project->id }}">
                            {{ $project->project_name }}
                        </a>
                        </h6>
                        <div class="dropdown">
                            <a style="text-decoration: none;" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </a>
                            <ul class="dropdown-menu shadow border border-0">
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editProject"
                                    wire:click="editProject({{ $project->id }})">Edit</a>
                                <a class="dropdown-item" wire:click="deleteProject({{ $project->id }})">Delete</a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-3">
                <div class="card shadow border border-0">
                    <div class="card-body   ">
                        <strong>!! No Project Avilable !!</strong>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
    {{-- <div class="table-data ">
        <div class="todo">
            <div class="justify-content-between head ms-3 p-2">
                <h3>Projects</h3>
                <a data-bs-toggle="modal" data-bs-target="#addProject"> <strong><i
                            class='bi bi-plus-circle-fill fontbrown '></strong></i></a>
            </div>
            <div class="customproject">
                <br>
                <ul class="todo-list ">
                    @if ($projects != '[]')
                        @foreach ($projects as $project)
                            <li class="high shadow">
                                <a wire:navigate href="{{ URL::to('/') }}/tasks/project/{{ $project->id }}"
                                    style="color:rgb(76, 76, 76) "> <strong>{{ $project->project_name }}</strong> </a>
                                <div class="dropdown">
                                    <a data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots  "></i>
                                    </a>
                                    <ul class="dropdown-menu shadow border border-0">
                                        <a class="dropdown-item " data-bs-toggle="modal" data-bs-target="#editProject"
                                            wire:click="editProject({{ $project->id }})">Edit </a>
                                        <a class="dropdown-item"
                                            wire:click="deleteProject({{ $project->id }})">Delete</a>
                                    </ul>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div> --}}
    @include('allModals.editProjectModal')
    @include('allModals.addProjectModal')

</div>
