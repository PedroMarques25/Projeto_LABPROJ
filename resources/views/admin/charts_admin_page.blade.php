@extends('layouts.app_admin')
<div class="row">
    <!-- Sidebar -->
    <div class="col-md-4">
        @include('admin.side_bar_page')
    </div>

    <!-- Charts -->
    <div class="col-md-8">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <div class="chart-container">
            <canvas id="myChart" width="100" height="50"></canvas>
        </div>-

        <script>
            var ctx = document.getElementById('myChart').getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Users', 'Guides', 'Routes', 'Countries'],
                    datasets: [{
                        label: 'This is my city',
                        data: [
                            {{ $userNumber }},
                            {{ $guideNumber }},
                            {{ $routesNumber }},
                            {{ $countriesNumber }}
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    // Adjust chart options if needed
                }
            });
        </script>
    </div>
</div>


