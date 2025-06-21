<div wire:ignore  wire:poll>
    <div class="">
        <h5 class="card-title ms-4 fontbrown  "><strong class="me-2 ">Pie Chart View :</strong> </h5>
    <canvas id="myChart" style="max-height: 42vh; max-width:100vw "></canvas>
</div>
<div>
    <h5 class="card-title ms-4 fontbrown mt-1  "><strong class="me-2 ">Bar Chart View :</strong></h5>
    <canvas id="myChart2" style="max-height: 42vh; max-width:100vw pt-1"></canvas>
</div>
</div>

{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}

<script>
    document.addEventListener('livewire:navigated', function() {
        const ctx = document.getElementById('myChart');

        // Initialize the chart
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Incompleted Tasks', 'Completed Task', 'MyTeam Tasks'],
                datasets: [{
                    label: 'Number of Tasks',
                    data: [
                        @json($incompleteTasks->count()),
                        @json($completedTasks->count()),
                        @json($teamTasks->count())
                    ],
                    backgroundColor: [
                        '#7E1652',
                        '#E66262',
                        '#E0B804'
                    ], // Add appropriate colors
                    borderWidth: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Function to update chart on Livewire component update
        window.livewire.on('updateChart', function() {
            myChart.data.datasets[0].data = [
                @json($incompleteTasks->count()),
                @json($completedTasks->count()),
                @json($teamTasks->count())
            ];
            myChart.update();
        });

        // Function to update chart on window resize
        function updateChart() {
            myChart.resize();
        }

        // Attach the updateChart function to the window resize event
        window.addEventListener('resize', updateChart);
    });
</script>

<script>
    document.addEventListener('livewire:navigated', function() {
        const ctx = document.getElementById('myChart2');

        // Initialize the chart
        const myChart2 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Incompleted Tasks', 'Completed Task', 'MyTeam Tasks'],
                datasets: [{
                    label: '# of Tasks',
                    data: [
                        @json($incompleteTasks->count()),
                        @json($completedTasks->count()),
                        @json($teamTasks->count())
                    ],
                    backgroundColor: [
                        '#7E1652',
                        '#E66262',
                        '#E0B804'
                    ], // Add appropriate colors
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }

            }
        });

        // Function to update chart on Livewire component update
        window.livewire.on('updateChart', function() {
            myChart.data.datasets[0].data = [
                @json($incompleteTasks->count()),
                @json($completedTasks->count()),
                @json($teamTasks->count())
            ];
            myChart.update();
        });

        // Function to update chart on window resize
        function updateChart() {
            myChart.resize();
        }

        // Attach the updateChart function to the window resize event
        window.addEventListener('resize', updateChart);
    });
</script>

