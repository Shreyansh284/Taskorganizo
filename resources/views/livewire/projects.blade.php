<div>
    <div class="table-data">
        <div class="todo">
            <div class="head">
                <h3>Projects</h3>
                <a data-toggle="modal"  data-target="#addproject"  style="text-decoration: none"> <strong><i class='bx bx-plus'></strong></i></a>

            </div>
            <div>
            <ul class="todo-list">
                @if($projects!="[]")
                @foreach ($projects as $project )
                <li class="high">
                    <a  wire:navigate href="{{ URL::to('/') }}/project/{{$project->project_name}}" style="text-decoration: none; color:rgb(76, 76, 76) " >  <strong>{{$project->project_name}}</strong>    </a>

                    <div class="dropdown">
                        <a wire:navigate  style="text-decoration: none" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                              </svg><i class="bi bi-three-dots"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <a class="dropdown-item" data-toggle="modal"  href="#editProject{{$project->project_name}}" >Edit</a>
                            <a href=""class="dropdown-item" >Delete</a>
                        </div>
                      </div>
                </li>
                <div class="modal fade" id="editProject{{$project->project_name}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidde     n="true">

                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Project Name</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST"  action="{{ URL::to('/') }}/projects" class="register-form" id="login-form">
                            @csrf
                          <div class="form-group">
                            <input type="text" class="form-control"  id="recipient-name" placeholder="Project Name" name="project_name" value="{{$project->project_name}}" required >
                            <span>
                                @error('project_name')
                            {{$message}}
                                @enderror
                            </span>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Edit</button>
                      </div>

                    </form>
                    </div>
                  </div>
                </div>

                @endforeach
                @endif
            </ul>
        </div>
        </div>
        </div>
        <div wire:ignore.self class="modal fade" id="addproject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Project</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" wire:submit="addProject" class="register-form">
                      @csrf
                    <div class="form-group">
                      <input type="text" wire:model="project_name" class="form-control" id="recipient-name" placeholder="Project Name" name="project_name"  value="{{ old('project_name') }}" >
                      <span>
                          @error('project_name')
                         {{$message}}
                          @enderror
                      </span>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger">Add</button>
                </div>

              </form>

              </div>
            </div>
          </div>




</div>
