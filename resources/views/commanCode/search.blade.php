<div class="sticky-top">
<div class="col-md-5 mx-auto">
    <div class="input-group mb-3">
    <i class="bi bi-search  input-group-text bg-white shadow border border-0"  id="basic-addon1"></i>
    <input wire:model.live.debounce="searchedTasks" class="form-control shadow border border-0 " type="search"
        placeholder="Search"  aria-describedby="basic-addon1">
    </div>

</div>
<div class="row mt-3 px-2">

    <div class="col-md-{{request()->is('today')? 4 : 3}} mt-2 ">
        <select wire:model.live="priorityFilter" class="form-select shadow border border-0 ">
            <option value="">Priority</option>
            <option value="high"  >High</option>
            <option value="medium">Medium</option>
            <option value="low">Low</option>
        </select>
    </div>

    <div class="col-md-{{request()->is('today')? 4 : 3}} mt-2">
        <select wire:model.live="labelFilter" class="form-select shadow border border-0 ">
            <option value="">Label</option>
            @foreach ($labels as $labelId => $labelName)
                <option value="{{ $labelId }}">{{ $labelName }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-{{request()->is('today')? 4 : 3}} mt-2">
        <select wire:model.live="projectFilter" class="form-select shadow border border-0 ">
            <option value="">Project</option>
            @foreach ($projects as $projectId => $projectName)
                <option value="{{ $projectId }}">{{ $projectName }}</option>
            @endforeach
        </select>
    </div>
    @if(!request()->is('today'))
    <div class="col-md-3 mt-2">
        <input wire:model.live="dueDateFilter" class="form-control shadow border border-0" type="date"
            placeholder="Due Date">
    </div>
    @endif
</div>



</div>


