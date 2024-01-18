@extends('master')
@section('link')
    <div id="basicsAccordion3">
        <div class="card mb-3">
            <div class="card-header card-collapse" id="basicsHeadingOne">
              <h5 class="mb-0">
                <button class="btn btn-block d-flex justify-content-between card-btn p-3"
                        data-toggle="collapse"
                        data-target="#basicsCollapseOne3"
                        aria-expanded="true"
                        aria-controls="basicsCollapseOne">
                      <strong style="color: rgb(184, 35, 35); text-decoration:none;" class="completed" >FILTERS</strong>
                      <i class='bx bx-filter' ></i>
                </button>
              </h5>
            </div>
            <div id="basicsCollapseOne3" class="collapse show"
                 aria-labelledby="basicsHeadingOne"
                 data-parent="#basicsAccordion3">
                 <div class="table-data">
                    <div class="todo">
                        <ul class="todo-list">
                            <li class="high">
                                <a href="{{ URL::to('/') }}/filter/priority/high" style="text-decoration: none; color:rgb(76, 76, 76) " >  <strong>High Priority</strong>    </a>
                            </li>
                            <li class="medium">
                                <a href="{{ URL::to('/') }}/filter/priority/medium"  style="text-decoration: none; color:rgb(76, 76, 76) " >  <strong>Medium Priority</strong>    </a>
                            </li>
                            <li class="low">
                                <a href="{{ URL::to('/') }}/filter/priority/low" style="text-decoration: none; color:rgb(76, 76, 76) " >  <strong>Low Priority</strong>    </a>
                            </li>
                        </ul>
                    </div>
                 </div>
            </div>
          </div>
        </div>


    <div id="basicsAccordion1">
      <div class="card mb-3">
        <div class="card-header card-collapse" id="basicsHeadingOne">
          <h5 class="mb-0">
            <button class="btn btn-block d-flex justify-content-between card-btn p-3"
                    data-toggle="collapse"
                    data-target="#basicsCollapseOne1"
                    aria-expanded="true"
                    aria-controls="basicsCollapseOne">
                  <strong style="color: rgb(184, 35, 35); text-decoration:none;" >LABELS</strong>

                  <a data-toggle="modal" data-target="#addlabel"  style="text-decoration: none"> <strong><i class='bx bx-plus'></strong></i></a>
            </button>
          </h5>
        </div>
        <div id="basicsCollapseOne1" class="collapse show"
             aria-labelledby="basicsHeadingOne"
             data-parent="#basicsAccordion1">
             <?php
              $labels = App\Http\Controllers\labelcontroller::getLabelsByEmail($email = session()->get('email'));
            ?>
             @if($labels!="[]")
                @foreach ($labels as $label )
                <div class="table-data">
                    <div class="todo">
                        <ul class="todo-list">
                            <li class="high">
                                <a href="{{ URL::to('/') }}/label/{{$label->label_name}}" style="text-decoration: none; color:rgb(76, 76, 76) " >  <strong>{{$label->label_name}}</strong>    </a>
                            </li>
                        </ul>
                    </div>
                 </div>
                @endforeach
                @endif
      </div>
      </div>


<div class="modal fade" id="addlabel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Label</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST"  action="{{ URL::to('/') }}/labels" class="register-form" id="login-form">
              @csrf
            <div class="form-group">
              <input type="text" class="form-control"  id="recipient-name" placeholder="Label Name" name="label_name" required >
              <span>
                  @error('label_name')
              {{$message}}
                  @enderror
              </span>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Add</button>
        </div>

      </form>
      </div>
    </div>
  </div>


@endsection
