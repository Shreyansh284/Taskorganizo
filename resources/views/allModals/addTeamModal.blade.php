<div wire:ignore.self class="modal fade" id="addTeam" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="">Add Team</h1>
                <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="addTeam">
                    <div class="form-group">
                        <input wire:model="team_name" type="text" class="form-control" id="recipient-name "
                            placeholder="Team Name">
                        <span>
                            @error('team_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn color">Add Team</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
