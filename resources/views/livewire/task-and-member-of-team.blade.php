<div wire:poll>
    @include('commanCode.alert')
    <div class="d-flex flex-wrap justify-content-evenly     mt-2 text-center">
        <h5 class="card-title  fontbrown mt-2 "><strong class="me-2 mb-2"> <a wire:navigate class="fontbrown" href="{{ URL::to('/') }}/myteams"> Team :</a> {{$team->team_name}}</strong></h5>

        <button type="button" class="btn color fontbrown"data-bs-toggle="modal" data-bs-target="#teamMembersModal">
            View Members
        </button>
        <button data-bs-toggle="modal" data-bs-target="#addTeamMember" class="btn color "  {{$team->created_by!==$user_id? 'disabled ':''}}> + Add Member</button>
    </div>

    <div class="row mt-3 pt-3 teamTaskView ">
    @forelse($tasks as $task)
        <div class="col-xl-4 col-lg-6 col-md-6  col-sm-12 mb-3">
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
@include('allModals.addTeamMemberModal')
@include('allModals.teamMemberModal')

</div>
