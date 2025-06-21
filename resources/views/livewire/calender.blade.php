<!-- resources/views/livewire/full-page-calendar.blade.php -->

<div class="calander" wire:poll>
    <div wire:ignore id="fullCalendar"></div>
</div>

@livewireScripts


<script>
    document.addEventListener('livewire:navigated', function() {
        const calendarEl = document.getElementById('fullCalendar');

        const tasks = @json($tasks);

        const formattedTasks = tasks.map(task => {
            return {
                title: task.task_name,
                start: task.due_date,
            };
        });
        console.log(formattedTasks);

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: formattedTasks,
            height: 650,
            stickyHeaderDates: true,
            dayMaxEventRows: 4,
            fixedWeekCount: false,
            eventClick: function(info) {
                Livewire.emit('showPopover', info.event.startStr);
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
        });

        calendar.render();

        function updateCalendarSize() {
            calendar.updateSize();
        }
        window.addEventListener('resize', updateCalendarSize);
    });
</script>
