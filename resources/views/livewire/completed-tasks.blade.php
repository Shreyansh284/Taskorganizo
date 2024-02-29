<div class="ps-2">
    <div class="sticky-top">
        <div class="col d-flex ">
            <h5 class="card-title ms-1 mt-2 fontbrown customtitle"><strong class="me-2">Completed Tasks</strong>
            </h5>
            @include('commanCode.search')
        </div>
        <div class="row d-flex justify-content-around px-2 fontbrown">
            <div class="col-lg-2 col-md-4 mt-2  ">
                <select wire:model.live="priorityFilter" class="form-select  cursor shadow border border-0 ">
                    <option class="cursor" value="">Priority</option>
                    <option class="cursor" value="high">High</option>
                    <option class="cursor" value="medium">Medium</option>
                    <option class="cursor" value="low">Low</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-4 mt-2">
                <select wire:model.live="labelFilter" class="form-select cursor shadow border border-0 ">
                    <option class="cursor" value="">Label</option>
                    @foreach ($labels as $labelId => $labelName)
                        <option class="cursor" value="{{ $labelId }}">{{ $labelName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2 col-md-4 mt-2">
                <select wire:model.live="projectFilter" class="form-select cursor shadow border border-0 ">
                    <option class="cursor" value="">Project</option>
                    @foreach ($projects as $projectId => $projectName)
                        <option class="cursor" value="{{ $projectId }}">{{ $projectName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2 col-md-6 mt-2 ">
                <input type="date" wire:model.live="startDate" class="form-control  cursor shadow border border-0 "
                    id="startDate">
            </div>
            <div class="col-lg-2 col-md-6 mt-2 ">
                <input type="date" wire:model.live="endDate" class="form-control  cursor shadow border border-0 "
                    id="endDate">
            </div>
        </div>
    </div>
    <div class="row mt-3 pt-3 custom ">
        @forelse($tasks as $task)
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-3">
                @include('commanCode.card', ['task' => $task])
            </div>
        @empty
            <div class="col-md-3">
                <div class="card shadow border border-0">
                    <div class="card-body fontbrown  ">
                        <strong>!! Task Not Found !!</strong>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
    @include('allModals.editTaskModal')
</div>
