<!-- livewire/upcoming-tasks.blade.php -->

<div>
    <div class="mt-2 mb-1 ms-3 fontbrown">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="startDate" class="form-label">Start Date:</label>
                <input type="date" wire:model.live="startDate" class="form-control  cursor shadow border border-0 "
                    id="startDate">
            </div>
            <div class="col-md-6">
                <label for="endDate" class="form-label">End Date:</label>
                <input type="date" wire:model.live="endDate" class="form-control  cursor shadow border border-0 "
                    id="endDate">
            </div>
        </div>
    </div>

    {{-- <div class="row  pt-3 px-2  flex-nowrap" >h
@foreach ($dates as $date)
<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 d-flex">
    <h6 class="card-title mb-2 fontbrown ms-2 m">{{ $date->format('D, M j') }}</h6>
</div>
        @endforeach
    </div> --}}

    <div class="row  pt-3 px-2  flex-nowrap customcalander">
        @foreach ($dates as $date)
            <div class="col-xl-4 col-lg-6 col-md-6  customcalandercard col-sm-12">
                @if (array_key_exists($date->format('D, M j'), $datesWithTasks))
                    <h6 class="card-title  fontbrown  sticky-top text-center"
                        style="height:5vh; background:rgb(238, 238, 238)">{{ $date->format('d M ‧ l') }}</h6>
                    @forelse ($datesWithTasks[$date->format('D, M j')] as $task)
                        @include('commanCode.card', ['task' => $task])
                        <br>
                    @empty
                        <div class="card shadow border border-0">
                            <div class="card-body fontbrown ">
                                <strong>!! Task Not Found !!</strong>
                            </div>
                        </div>
                    @endforelse
                @endif
            </div>
        @endforeach
    </div>
    @include('allModals.editTaskModal')
</div>
