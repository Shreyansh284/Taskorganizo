<div wire:ignore.self class="modal fade" id="teamMembersModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="">Team Members</h1>
                <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body teamModalOverflow">
                @foreach ($users as $user)
                    <ol class="list-group  mb-1 ">
                        <li class="list-group-item d-flex justify-content-evenly align-items-center">
                            <div class="ms-2 me-auto">

                                <div class="fw-bold">{{ $user->name }}</div>
                                {{ $user->email }}

                                @if ($team->created_by == $user_id)
                                    @if ($user->pivot->status == 'Accepted' && $user->id != $team->created_by)
                                        <i class="bi ms-1 text-success bi-check-circle-fill"></i>
                                    @endif

                                    @if ($user->pivot->status == 'Pending')
                                        <i class="bi ms-1 text-warning bi-hourglass-split"></i>
                                    @endif
                                @endif

                            </div>
                            <div>
                                @if ($user->id == $team->created_by)
                                    <span class="fontbrown">Admin</span>
                                @else
                                    @if ($team->created_by == $user_id)
                                        <a wire:click="removeMember({{ $user->id }},{{ $team->id }}) " <i
                                            class="bi iconColor bi-trash "></i> </a>
                                    @endif
                                @endif
                            </div>
                        </li>
                    </ol>
                @endforeach

            </div>

        </div>
    </div>
</div>
