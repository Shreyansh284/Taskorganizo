<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="reg/css/style.css">
    <link rel="stylesheet" href="reg/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="/dashboard/style.css">


    <title>ME*TODO</title>
</head>

<body>
    @yield('bootstrap')

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="index" class="brand" style="text-decoration: none">
            <i class='bx bxs-smile'></i>
            <span class="text">ME*TODO</span>
        </a>
        <ul class="side-menu top">
            <li class="">
                <a data-toggle="modal" data-target="#addtask">
                    &nbsp; &nbsp;&nbsp;<i class="fa fa-plus"></i>
                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="text">Add Task</span>
                </a>
            </li>
            <li class="">
                <a wire:navigate href="{{ URL::to('/') }}/index" style="text-decoration: none">
                    <i class="bx bxs-dashboard"></i>
                    <span class="text">Inbox</span>
                </a>
            </li>
            <li>
                <a wire:navigate href="{{ URL::to('/') }}/today" style="text-decoration: none">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">Today</span>
                </a>
            </li>
            <li>
                <a  wire:navigatehref="{{ URL::to('/') }}/upcoming" style="text-decoration: none">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Upcoming</span>
                </a>
            </li>
            <li>
                <a wire:navigate href="{{ URL::to('/') }}/filterAndLabel" style="text-decoration: none">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">Fliter & Label</span>
                </a>
            </li>
            <li>
                <a wire:navigate href="{{ URL::to('/') }}/project" style="text-decoration: none">
                    <i class='bx bxs-group'></i>
                    <span class="text">Projects</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">

            <li>
                <a wire:navigate href="{{ URL::to('/') }}/logout" class="logout" style="text-decoration: none">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->


    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>


            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="img/people.png">
            </a>
        </nav>
        <main>
            <div class="modal fade" id="addtask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ URL::to('/') }}/tasks" class="register-form">
                                @csrf
                                <div class="form-group">

                                    <input type="text" class="form-control" id="recipient-name "
                                        placeholder="Task Name" name="task_name" required>
                                    <span>
                                        @error('task_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">

                                    <textarea class="form-control" id="message-text" name="task_description" placeholder="Task Description"></textarea>
                                    <span>
                                        @error('task_description')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">

                                    <input type="date" class="form-control" id="recipient-name" name="due_date"
                                        placeholder="Due Date">
                                    <span>
                                        @error('due_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $projects=App\Http\Controllers\projectcontroller::getProjectsByEmail($email=session()->get('email'));
                                    ?>
                                    <select class="form-select" aria-label="Default select example" name="projectName">
                                        <option value="{{ null }}">Choose Project</option>
                                        @if ($projects != '[]')
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->project_name }}">
                                                    {{ $project->project_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>


                                    <span>
                                        @error('projectName')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <select class="form-select" aria-label="Default select example" name="priority">
                                        <option value="low">Choose Priority</option>
                                        <option value="low"name="priority">Low</option>
                                        <option value="medium"name="priority">Medium</option>
                                        <option value="high"name="priority">High</option>
                                    </select>
                                    <span>
                                        @error('priority')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <?php
                                    $labels = App\Http\Controllers\labelcontroller::getLabelsByEmail($email = session()->get('email'));
                                    ?>
                                    <select class="form-select" aria-label="Default select example" name="labelName">
                                        <option value="{{ null }}">Choose Label</option>
                                        @if ($labels != '[]')
                                            @foreach ($labels as $label)
                                                <option value="{{ $label->label_name }}">{{ $label->label_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span>
                                        @error('label')
                                            {{ $message }}
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
            @yield('link')
        </main>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="/dashboard/script.js"></script>
    <script src="reg/vendor/jquery/jquery.min.js"></script>
    <script src="reg/js/main.js"></script>

    {{-- <script>
    window.addEventListener('hide',event =>{
        $(#addProject).modal('hide');
    })
    </script> --}}

</body>

</html>
