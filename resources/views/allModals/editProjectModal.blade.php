<div wire:ignore.self class="modal fade" id="editProject" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="">Edit Project</h1>
                <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="updateProject">
                    <div class="form-group">
                        <input wire:model="edit_project_name" type="text" class="form-control">
                        <span>
                            @error('edit_project_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn color">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
