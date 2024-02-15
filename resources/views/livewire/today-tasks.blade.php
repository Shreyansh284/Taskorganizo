<div>

    @include('commanCode.search')

    <h5 class="card-title mt-5 ms-2" style="color: brown"><strong>Today :</strong></h5>

    <div class="row mt-3 pt-3 px-2">
        @forelse($tasks as $task)
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-3">
                @include('commanCode.card',['task'=>$task])
            </div>
        @empty
            <div class="col-md-3">
                <div class="card shadow border border-0">
                    <div class="card-body  ">
                        <strong style="color: brown">!! Task Not Found !!</strong>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
    <div><a data-bs-toggle="modal" data-bs-target="#addTask" class="card-title  fw-semibold ms-2"
            style="font-size: 15px;  color:brown"><i style="font-size: 25px; color:brown"
                class="bi bi-plus-circle-fill mr-2"></i> Add Task </a>
    </div>

</div>
