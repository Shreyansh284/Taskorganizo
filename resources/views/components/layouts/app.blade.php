<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    {{-- @notifyCss --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/reg/css/style.css">
    <link rel="stylesheet" href="/dashboard/style.css">
    @livewireStyles()
    <title>TaskOrganizo</title>
</head>

<body>


    <aside id="sidebar">

        <a wire:navigate href="{{ URL::to('/') }}/inbox" class="brand fontbrown">
            <i class="bi bi-calendar2-check-fill ms-4"></i>
            <span class="text ms-2  ">TaskOrganizo</span>
        </a>

        <ul class="side-menu top">


            <li>
                <a data-bs-toggle="modal" data-bs-target="#addTask">
                    <i class="bi bi-plus-circle-fill ms-2 " style="color: #a12c28; font-size:18px"></i><span
                        class="text ms-2" style="color: #a12c28"> <strong style="font: bolder">Add Task</strong></span>
                </a>
            </li>

            <li @class(['active' => request()->is('inbox')])>
                <a wire:navigate href="{{ URL::to('/') }}/inbox">
                    <i class="bi bi-inbox-fill  ms-2"></i>
                    <span class="text ms-2">Inbox</span>
                </a>
            </li>
            <li @class(['active' => request()->is('today')])>
                <a wire:navigate href="{{ URL::to('/') }}/today">
                    <i class="bi bi-calendar2  ms-2"></i>
                    <span class="text  ms-2">Today</span>
                </a>
            </li>
            <li @class(['active' => request()->is('calender-view')])>
                <a wire:navigate href="{{ URL::to('/') }}/calender-view">
                    <i class="bi bi-calendar3  ms-2"></i>
                    <span class="text  ms-2">Calender-View</span>
                </a>
            </li>

            <li @class([
                'active' =>
                    request()->is('labels') ||
                    str_starts_with(request()->path(), 'tasks/label/'),
            ])>
                <a wire:navigate href="{{ URL::to('/') }}/labels">
                    <i class="bi bi-tags  ms-2"></i>
                    <span class="text ms-2">Labels</span>
                </a>
            </li>
            <li @class([
                'active' =>
                    request()->is('projects') ||
                    str_starts_with(request()->path(), 'tasks/project/'),
            ])>
                <a wire:navigate href="{{ URL::to('/') }}/projects">
                    <i class="bi bi-collection  ms-2"></i>
                    <span class="text ms-2">Projects</span>
                </a>
            </li>
            <li @class(['active' => request()->is('completed')])>
                <a wire:navigate href="{{ URL::to('/') }}/completed">
                    <i class="bi bi-list-check ms-2"></i>
                    <span class="text ms-2">Completed Tasks</span>
                </a>
            </li>
            <li @class(['active' => request()->is('team')])>
                <a wire:navigate href="{{ URL::to('/') }}/team">
                    <i class="bi bi-people-fill ms-2"></i>
                    <span class="text ms-2">Teams</span>
                </a>
            </li>
            <li>
                <a wire:navigate href="{{ URL::to('/') }}/logout" class="logout mt-5">
                    <i class="bi bi-box-arrow-left  ms-2"></i>
                    <span class="text ms-2">Logout</span>
                </a>
            </li>
        </ul>
    </aside>
    <section id="content">

        <nav class="navbar  fw-bold bg-light justify-content-end pb-3 pe-5">

            <a wire:navigate href="myProfile">

                <i class="bi bi-person-fill ms-4""></i>
                <span class="text ms-2 fontbrown  ">My Profile</span>
            </a>
        </nav>
        <main>
            @livewire('layout')
            {{ $slot }}
        </main>
    </section>
    <script data-navigate-once src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    {{-- @notifyJs --}}
    <script>
        window.addEventListener('close-model', event => {
            $('#addTask').modal('hide');
            $('#editTask').modal('hide');
            $('#addProject').modal('hide');
            $('#editProject').modal('hide');
            $('#addLabel').modal('hide');
            $('#editLabel').modal('hide');
        })
    </script>
    @livewireScripts()

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeSidebarToggle();

            Livewire.hook('afterDomUpdate', () => {
                initializeSidebarToggle();
            });

            function initializeSidebarToggle() {
                const sidebar = document.getElementById('sidebar');
                const sidebarToggle = document.getElementById('sidebar-toggle');

                if (sidebar && sidebarToggle) {
                    sidebarToggle.addEventListener('click', function() {
                        sidebar.classList.toggle('active');
                    });
                }
            }
        });
    </script> --}}
</body>

</html>
