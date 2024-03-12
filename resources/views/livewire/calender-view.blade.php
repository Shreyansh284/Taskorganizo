<!-- livewire/upcoming-tasks.blade.php -->

<div wire:poll.keep-alive>
    @include('commanCode.alert')
    <div class="mt-2 mb-1 ms-3 stickycalender d-flex justify-content-center fontbrown">
        <div class="row mb-3">
            <div class="col-md-4 col-sm-4 col-4">
                <label for="startDate" class="form-label">Start Date:</label>
                <input type="date" wire:model="startDate" class="form-control  cursor shadow border border-0 "
                    id="startDate">
                    <span>
                        @error('startDate')
                            {{ $message }}
                        @enderror
                    </span>
            </div>
            <div class="col-md-4 col-sm-4 col-4">
                <label for="endDate" class="form-label">End Date:</label>
                <input type="date" wire:model="endDate" class="form-control  cursor shadow border border-0 "
                    id="endDate">
                    <span>
                        @error('endDate')
                            {{ $message }}
                        @enderror
                    </span>
            </div>
            <div class="col-md-4 col-sm-4 col-4 mt-2 pt-4">
              <button class="btn color" wire:click="renderAfterSubmit" >Submit</button>
            </div>
        </div>
    </div>
    <div class="row  pt-3 px-2  flex-nowrap calanderDiv">
        @foreach ($dates as $date)
            <div class="col-xl-4 col-lg-6 col-md-6  calanderCardsDiv col-sm-12">
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
