<div wire:poll>
</head>
<body>
    @include('commanCode.alert')
        <div class="d-flex justify-content-between mt-2">
        <h5 class="card-title ms-4 fontbrown mt-2 "><strong class="me-2">Teams</strong></h5>
        <button data-bs-toggle="modal" data-bs-target="#addTeam" class="btn color me-2"> + Add Team</button>
    </div>
    <div class="d-flex wrap">
    <div class="row mt-4  pt-3  ">
        <div class="">
        <h5 class="card-title  fontbrown mt-2 ms-4 mb-3"><strong>My Teams</strong></h5>
    </div>
    <div class="teamcontainer mx-2 d-flex">
        @forelse($myTeams as $team)
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12  mb-3">
                <div class="teamCard shadow border boder-0 mx-2 p-3">

                    <div class="d-flex justify-content-between">
                        <h6 class="card-title ">
                            <a wire:navigate href="{{ URL::to('/') }}/team/{{$team->id}}/taskAndUsers"  class="text-dark"   >
                             {{$team->team_name}}
                        </a>
                        </h6>
                        <div class="dropdown">
                            <a style="text-decoration: none;" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi iconColor bi-three-dots"></i>
                            </a>
                            <ul wire:ignore.self class="dropdown-menu shadow border border-0">
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editTeam"
                                wire:click="editTeam({{ $team->id }})"   >Edit</a>
                                <a class="dropdown-item" wire:click="deleteTeam({{ $team->id }})"  >Delete</a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-6 col-sm-6 mb-1">
                <div class="card  border border-0">
                    <div class="card-body   ">
                        <strong>!! No Team Avilable !!</strong>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
    <div class="row mt-4  pt-3 ">
         <h5 class="card-title ms-4 fontbrown mt-2  mb-4 " style="background: rgb(237, 237, 237)"><strong class="me-2">Other Teams</strong></h5>
         <div class="teamcontainer mx-2 d-flex flex-wrap">
         @forelse($memberTeams as $team)
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                <div class="teamCard shadow border boder-0 mx-2 p-3">

                    <div class="d-flex justify-content-between">
                        <h6 class="card-title ">
                            <a wire:navigate href="{{ URL::to('/') }}/team/{{$team->id}}/taskAndUsers"  class="text-dark">
                             {{$team->team_name}}
                        </a>
                        </h6>
                        <div class="dropdown">

                                <i class="bi iconColor notallowed bi-three-dots"></i>

                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-6 pb-1">
                <div class="card border border-0">
                    <div class="card-body   ">
                        <strong>!! No Team Avilable !!</strong>
                    </div>
                </div>
            </div>
            @endforelse
         </div>
    </div>
    </div>

    @include('allModals.editTeamModal')
    @include('allModals.addTeamModal')

</div>
