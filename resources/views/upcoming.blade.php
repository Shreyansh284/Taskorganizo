
@extends('master')
@section('link')

<div  class="row-xl-3">

<div class="col-xl" >

<div  class="row">

    <div class="col-xl-2 mb-4"> <h3>9.jan Today</h3></div>
    <div class="col-xl-1 mb"> <button type="button"   data-toggle="modal" data-target="#exampleModal" class="btn btn-danger  rounded-circle  btn-sm"  style="width: 32px ;height:32px; margin-top:5px"> <i class="fa fa-plus" style="margin-left:-1px; "></i></button></div>
</div>

<div class="row">
    <div class="col-xl-3 mb-4">
      <div class=" card border border-4 border">
        <div class="card-body text">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">

              <div class="ms-3">
                <p class="fw-bold mb-1">TASK1</p>
                <p class=""> TASK DESCPRITION</p>
            </div>
        </div>
        <div class="fw-bold badge bg text-wrap "> </div>
        </div>
        </div>
        <div
          class="card-footer border-0 bg-body-tertiary p-2 d-flex justify-content-around"
        >

            <a
            class="btn btn-link m-0 text-reset"
            href=""
            role="button"
            data-ripple-color="primary"
            data-mdb-ripple-init
            ><button class="btn btn-warning rounded-circle btn-sm" style="width: 32px ;height:32px" ><i class="fa fa-edit" ></i></button></a>
            <a
            class="btn btn-link m-0 text-reset"
            href=""
            role="button"
            data-ripple-color="primary"
            data-mdb-ripple-init
            ><button class="btn btn-success rounded-circle btn-sm" style="width: 32px ;height:32px" ><i class="fa fa-check" ></i></button></a>
          <a
            class="btn btn-link m-0 text-reset"
            href="{{ URL::to('/') }}/delete/"
            role="button"
            data-ripple-color="primary"
            data-mdb-ripple-init
            ><button class="btn btn-danger rounded-circle btn-sm" style="width: 32px ;height:32px" ><i class="fa fa-trash" style="font-size: 18px" ></i></button></a>

        </div>
    </div>
</div>
</div>
</div>
<div class="col-xl" >

    <div  class="row">

        <div class="col-xl-1 mb-4"> <h3>10.jan Tomorrow</h3></div>
        <div class="col-xl-1 mb"> <button type="button"   data-toggle="modal" data-target="#exampleModal" class="btn btn-danger  rounded-circle  btn-sm"  style="width: 32px ;height:32px; margin-top:5px"> <i class="fa fa-plus" style="margin-left:-1px; "></i></button></div>



    </div>

    <div class="row">
        <div class="col-xl-3 mb-4">
          <div class=" card border border-4 border">
            <div class="card-body text">
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">

                  <div class="ms-3">
                    <p class="fw-bold mb-1">TASK1</p>
                    <p class=""> TASK DESCPRITION</p>
                </div>
            </div>
            <div class="fw-bold badge bg text-wrap "> </div>
            </div>
            </div>
            <div
              class="card-footer border-0 bg-body-tertiary p-2 d-flex justify-content-around"
            >

                <a
                class="btn btn-link m-0 text-reset"
                href=""
                role="button"
                data-ripple-color="primary"
                data-mdb-ripple-init
                ><button class="btn btn-warning rounded-circle btn-sm" style="width: 32px ;height:32px" ><i class="fa fa-edit" ></i></button></a>
                <a
                class="btn btn-link m-0 text-reset"
                href=""
                role="button"
                data-ripple-color="primary"
                data-mdb-ripple-init
                ><button class="btn btn-success rounded-circle btn-sm" style="width: 32px ;height:32px" ><i class="fa fa-check" ></i></button></a>
              <a
                class="btn btn-link m-0 text-reset"
                href="{{ URL::to('/') }}/delete/"
                role="button"
                data-ripple-color="primary"
                data-mdb-ripple-init
                ><button class="btn btn-danger rounded-circle btn-sm" style="width: 32px ;height:32px" ><i class="fa fa-trash" style="font-size: 18px" ></i></button></a>

            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

@endsection
