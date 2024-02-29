<div>
    <div class="d-flex justify-content-between mt-2">
        <h5 class="card-title ms-4 fontbrown mt-2 "><strong class="me-2">Labels</strong></h5>
        <button data-bs-toggle="modal" data-bs-target="#addLabel" class="btn color"> + Add Label</button>
    </div>
    <div class="row mt-4 ms-3 pt-3 customlabel ">
        @forelse($labels as $label)
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-3">
                <div class="card  shadow border boder-0 p-3">

                    <div class="d-flex justify-content-between">
                        <h6 class="card-title ">
                            <a  class="text-dark"  wire:navigate href="{{ URL::to('/') }}/tasks/label/{{ $label->id }}">
                                {{ $label->label_name }}
                            </a>
                        </h6>
                        <div class="dropdown">
                            <a style="text-decoration: none;" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </a>
                            <ul class="dropdown-menu shadow border border-0">
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editLabel"
                                    wire:click="editLabel({{ $label->id }})">Edit</a>
                                <a class="dropdown-item" wire:click="deleteLabel({{ $label->id }})">Delete</a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-3">
                <div class="card shadow border border-0">
                    <div class="card-body   ">
                        <strong>!! No Label Avilable !!</strong>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
    @include('allModals.editLabelModal')
    @include('allModals.addLabelModal')

</div>
