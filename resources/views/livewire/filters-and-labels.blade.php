<div class="px-3">
          <div class="table-data">
            <div class="todo">
                <div class="head ">
                    <div class="flex-grow-1">
                        <button style="width: -webkit-fill-available" class="btn  text-start justify-content-between p-3"  data-bs-toggle="collapse" data-bs-target="#priorityCollapse" aria-expanded="false" aria-controls="priorityCollapse" >
                              <strong class="completed fontbrown" >FILTER</strong>
                            </button>
                        </div>
                        <div class= "justify-content-between p-3"><i class="bi bi-filter fontbrown" "></i></div>
                </div>

                <div id="priorityCollapse" class="collapse mt-3">

                <ul class="todo-list">
                    <li class="high shadow ">
                        <a  wire:navigate href="{{ URL::to('/') }}/filter/priority/high" style="color:rgb(76, 76, 76) " >  <strong>High Priority</strong>    </a>
                    </li>
                    <li class="medium shadow ">
                        <a  wire:navigate href="{{ URL::to('/') }}/filter/priority/medium"  style=" color:rgb(76, 76, 76) " >  <strong>Medium Priority</strong>    </a>
                    </li>
                    <li  class="low shadow ">
                        <a  wire:navigate href="{{ URL::to('/') }}/filter/priority/low" style=" color:rgb(76, 76, 76) " >  <strong>Low Priority</strong>    </a>
                    </li>
                </ul>
            </div>
            </div>
            </div>


     <div class="table-data" >
        <div class="todo">
            <div class="head">
                <div class="flex-grow-1">
                    <button style="width: -webkit-fill-available" class="btn text-start p-3"  data-bs-toggle="collapse" data-bs-target="#label1Collapse" aria-expanded="false" aria-controls="label1Collapse" >
                          <strong  class="completed fontbrown" >LABELS</strong>
                        </button>
                    </div>
                    <div class= "justify-content-between p-3"><a  data-bs-toggle="modal" data-bs-target="#addLabel"> <i class="bi-plus-circle-fill" ></i></a></div>

            </div>

            <div id="label1Collapse"  class="collapse mt-3" wire:ignore.self>
                @if($labels!="[]")
                <ul class="todo-list">
                    @foreach ($labels as $label )
                    <li class="high shadow" >
                        <a  wire:navigate href="{{ URL::to('/') }}/label/{{$label->label_name}}" style=" color:rgb(76, 76, 76) ;" >  <strong>{{$label->label_name}}</strong>    </a>
                          <div class="dropdown">
                            <a data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </a>
                            <ul class="dropdown-menu shadow border border-0">
                              <a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#editLabel" wire:click="editLabel({{$label->id}})">Edit</a>
                              <a class="dropdown-item" wire:click="deleteLabel({{$label->id}})" >Delete</a>
                            </ul>
                          </div>
                    </li>

               @endforeach
            </ul>
            @endif
        </div>
        </div>
        </div>
        <div wire:ignore.self class="modal fade" id="editLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="">Edit Label</h1>
                        <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit="updateLabel" >
                            <div class="form-group">
                                <input wire:model="edit_label_name" type="text" class="form-control"
                                    >
                                <span>
                                    @error('edit_label_name')
                                        {{ $message}}
                                    @enderror
                                </span>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn color" >Edit</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>

        </div>
          <div wire:ignore.self class="modal fade border-0" id="addLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Add Label</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" wire:submit="addLabel">
                        @csrf
                        <div class="form-group">
                            <input  wire:model="label_name"  type="text" class="form-control" id="recipient-name "
                                placeholder="Label Name" >
                            <span>
                                @error('label_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn color">Add Label</button>
                </div>
                </form>

                </div>

              </div>
            </div>
        </div>
        </div>


