<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

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
        <div class="d-flex">
            <a wire:navigate href="{{ URL::to('/') }}/inbox" class="brand fontbrown">
                <i class="bi iconColor bi-calendar2-check-fill ms-4"></i>
                <span class="text ms-2  ">TaskOrganizo</span>

            </a>
            <button id="closeSidebar" class="btn border-0 ">
                <i class="bi iconColor bi-x"></i>
            </button>
        </div>

        <ul class="side-menu top">
            <li>
                <a data-bs-toggle="modal" data-bs-target="#addTask">
                    <i class="bi iconColor bi-plus-circle-fill ms-2 " style="color: #a12c28; font-size:18px"></i><span
                        class="text ms-2" style="color: #a12c28"> <strong style="font: bolder">Add Task</strong></span>
                </a>
            </li>

            <li @class(['active' => request()->is('inbox')])>
                <a wire:navigate href="{{ URL::to('/') }}/inbox">
                    <i class="bi iconColor bi-inbox-fill  ms-2"></i>
                    <span class="text ms-2">Inbox</span>
                </a>
            </li>
            <li @class(['active' => request()->is('today')])>
                <a wire:navigate href="{{ URL::to('/') }}/today">
                    <i class="bi iconColor bi-calendar2  ms-2"></i>
                    <span class="text  ms-2">Today</span>
                </a>
            </li>
            <li @class(['active' => request()->is('calender-view')])>
                <a wire:navigate href="{{ URL::to('/') }}/calender-view">
                    <i class="bi iconColor bi-calendar3  ms-2"></i>
                    <span class="text  ms-2">Calender-View</span>
                </a>
            </li>

            <li @class([
                'active' =>
                    request()->is('labels') ||
                    str_starts_with(request()->path(), 'tasks/label/'),
            ])>
                <a wire:navigate href="{{ URL::to('/') }}/labels">
                    <i class="bi iconColor bi-tags  ms-2"></i>
                    <span class="text ms-2">Labels</span>
                </a>
            </li>
            <li @class([
                'active' =>
                    request()->is('projects') ||
                    str_starts_with(request()->path(), 'tasks/project/'),
            ])>
                <a wire:navigate href="{{ URL::to('/') }}/projects">
                    <i class="bi iconColor bi-view-list  ms-2"></i>
                    <span class="text ms-2">Projects</span>
                </a>
            </li>
            <li @class(['active' => request()->is('completed')])>
                <a wire:navigate href="{{ URL::to('/') }}/completed">
                    <i class="bi iconColor bi-list-check ms-2"></i>
                    <span class="text ms-2">Completed Tasks</span>
                </a>
            </li>
            <li @class(['active' => request()->is('teams')])>
                <a wire:navigate href="{{ URL::to('/') }}/teams">
                    <i class="bi iconColor bi-people-fill ms-2"></i>
                    <span class="text ms-2">Teams</span>
                </a>
            </li>
            <li @class(['active' => request()->is('statistics')])>
                <a wire:navigate href="{{ URL::to('/') }}/statistics">
                    <i class="bi iconColor bi-pie-chart-fill ms-2"></i>
                    <span class="text ms-2">Statistics</span>
                </a>
            </li>
            <li>
                <a wire:navigate href="{{ URL::to('/') }}/logout" class="logout mt-5">
                    <i class="bi iconColor bi-box-arrow-left  ms-2"></i>
                    <span class="text ms-2">Logout</span>
                </a>
            </li>
        </ul>
    </aside>
    <section id="content">

        <nav class="navbar fw-bold bg-light justify-content-between pb-3 pe-5">
            <div class="d-flex align-items-center">
                <button id="showSidebar" class="btn border-0 d-lg-none">
                    <i class="bi iconColor bi-list"></i>
                </button>
            </div>
            <a wire:navigate href="{{ URL::to('/') }}/myProfile" class="d-flex align-items-center">
                <i class="bi iconColor bi-person-fill ms-4"></i>
                <span class="text ms-2 fontbrown">My Profile</span>
            </a>
        </nav>

        <main>
            @livewire('layout')
            {{ $slot }}
        </main>
    </section>
    <script data-navigate-once src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script data-navigate-once src="{{ asset('dashboard/sidebar&modal.js') }}" defer></script>

    @livewireScripts()
</body>

</html>
