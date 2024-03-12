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
                        <input wire:model="label_name" type="text" class="form-control" id="recipient-name "
                            placeholder="Label Name">
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
