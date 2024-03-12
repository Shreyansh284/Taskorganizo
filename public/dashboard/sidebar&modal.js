
document.addEventListener('livewire:navigated', function() {
    const showSidebarButton = document.getElementById('showSidebar');
    const closeSidebarButton = document.getElementById('closeSidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');

    function showSidebar() {
        sidebar.classList.remove('d-none');
    }

    function closeSidebar() {
        sidebar.classList.add('d-none');
    }

    function toggleSidebar() {
        sidebar.classList.toggle('d-none');
    }

    if (showSidebarButton) {
        showSidebarButton.addEventListener('click', showSidebar);
    }

    if (closeSidebarButton) {
        closeSidebarButton.addEventListener('click', closeSidebar);
    }

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', toggleSidebar);
    }

    function hideSidebarOnSmallScreens() {
        if (window.innerWidth < 1000 && !sidebar.classList.contains('d-none')) {
            sidebar.classList.add('d-none');
        } else if (window.innerWidth >= 1000 && sidebar.classList.contains('d-none')) {
            sidebar.classList.remove('d-none');
        }
    }

    function updateButtonVisibility() {
        const isSmallScreen = window.innerWidth < 1000;

        if (isSmallScreen) {
            closeSidebarButton.classList.remove('d-none');
        } else {
            closeSidebarButton.classList.add('d-none');
        }
    }

    window.addEventListener('resize', function() {
        hideSidebarOnSmallScreens();
        updateButtonVisibility();
    });

    hideSidebarOnSmallScreens();
    updateButtonVisibility();
});

window.addEventListener('close-model', event => {
    $('#addTask').modal('hide');
    $('#editTask').modal('hide');
    $('#addProject').modal('hide');
    $('#editProject').modal('hide');
    $('#addLabel').modal('hide');
    $('#editLabel').modal('hide');
    $('#addTeam').modal('hide');
    $('#editTeam').modal('hide');
    $('#addTeamMember').modal('hide');
});

window.addEventListener('livewire:navigated', function () {
    setTimeout(function () {
        document.getElementById('successAlert').style.display = 'none';
    }, 4000);
});

