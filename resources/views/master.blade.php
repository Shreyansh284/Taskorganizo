<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/svg+xml" href="favicon.svg">
        @notifyCss
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="reg/css/style.css">
        <link rel="stylesheet" href="/dashboard/style.css">
        @livewireStyles()
        <title>TaskOrganizo</title>
    </head>
    <body>

      

    <aside id="sidebar">

            <a wire:navigate href="index" class="brand fontbrown" >
                <i class="bi bi-calendar2-check-fill ms-5"></i>
                <span class="text ms-2  ">TaskOrganizo</span>
            </a>

        <ul class="side-menu top">


    <li>
        <a data-bs-toggle="modal" data-bs-target="#addTask" >
            <i class="bi bi-plus-circle-fill ms-2 " style="color: #a12c28; font-size:18px" ></i><span class="text ms-2" style="color: #a12c28" >  <strong style="font: bolder" >Add Task</strong></span>
        </a>
    </li>

    <li class="{{request()->is('index')?'active ':''}} ">
        <a wire:navigate href="{{ URL::to('/') }}/index" >
            <i class="bi bi-list-task  ms-2"></i>
                <span class="text ms-2">Inbox</span>
            </a>
        </li>
        <li  class="{{request()->is('today')?'active':''}}">
            <a wire:navigate href="{{ URL::to('/') }}/today" >
                <i class="bi bi-calendar2  ms-2"></i>
                <span class="text  ms-2">Today</span>
            </a>
        </li>
        <li  class="{{request()->is('upcoming')?'active':''}}">
            <a  wire:navigate href="{{ URL::to('/') }}/upcoming" >
                <i class="bi bi-calendar3  ms-2"></i>
                <span class="text  ms-2">Upcoming</span>
            </a>
        </li>
        <li  class="{{request()->is('filterAndLabel')?'active':''}}">
            <a wire:navigate href="{{ URL::to('/') }}/filterAndLabel" >
                <i class="bi bi-grid  ms-2"></i>
                <span class="text ms-2">Fliter & Label</span>
            </a>
        </li>
        <li  class="{{request()->is('project')?'active':''}}">
            <a wire:navigate href="{{ URL::to('/') }}/project" >
                <i class="bi bi-collection  ms-2"></i>
                <span class="text ms-2">Projects</span>
            </a>
        </li>
        <li  class="{{request()->is('completed')?'active':''}}">
            <a wire:navigate href="{{ URL::to('/') }}/completed" >
                <i class="bi bi-ui-checks ms-2"></i>
                <span class="text ms-2">Completed Tasks</span>
            </a>
        </li>
        <li>
            <a  href="{{ URL::to('/') }}/logout" class="logout mt-5" >
                <i class="bi bi-box-arrow-left  ms-2"></i>
                <span class="text ms-2">Logout</span>
            </a>
        </li>
    </ul>
</aside>
<section id="content">

    <nav class="navbar  fw-bold bg-light justify-content-end pb-3 pe-5" >

            <a href="myProfile"  >

                <i class="bi bi-person-fill ms-4""></i>
                <span class="text ms-2 fontbrown  ">My Profile</span>
            </a>
      </nav>
    <main>
        @livewire('layout')
        @yield('link')
    </main>

</section>
<script data-navigate-once src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script  data-navigate-once src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script  data-navigate-once src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
@notifyJs
<script>
    window.addEventListener('close-model',event =>{
        $('#addTask').modal('hide');
        $('#editTask').modal('hide');
        $('#addProject').modal('hide');
        $('#editProject').modal('hide');
        $('#addLabel').modal('hide');
        $('#editLabel').modal('hide');
    })
</script>
@livewireScripts()

<script>
    document.addEventListener('DOMContentLoaded', function () {
        initializeSidebarToggle();

        Livewire.hook('afterDomUpdate', () => {
            initializeSidebarToggle();
        });

        function initializeSidebarToggle() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');

            if (sidebar && sidebarToggle) {
                sidebarToggle.addEventListener('click', function () {
                    sidebar.classList.toggle('active');
                });
            }
        }
    });
</script>
</body>
</html>
