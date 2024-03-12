        <div class="input-group shadow border rounded border-0 me-2 mb-3 inboxSearch ">
            <i class="bi bi-search iconColor  input-group-text bg-white  border-0" id="basic-addon1"></i>
            <input wire:model.live.debounce="searchedTasks" class="form-control  border-0 " type="search"
                placeholder="Search" aria-describedby="basic-addon1">
        </div>
