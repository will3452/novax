@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Predictions</h1>
            <a href="/admin" class="btn btn-primary">Back to Management</a>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between items-center">
                    <div>Orders</div>
                    <div>
                        <div class="d-flex">
                            <div style="width:25px;height:25px;background: rgba(75, 192, 192, 1);margin-right:5px;margin-left:10px;"></div> Data
                            <div style="width:25px;height:25px;background: rgba(75, 255, 192, 1);margin-right:5px;margin-left:10px;"></div> Prediction
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="dl" class="w-100 h-auto"></canvas>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between items-center">
                    <div>Pre-Orders</div>
                    <div>
                        <div class="d-flex">
                            <div style="width:25px;height:25px;background: rgba(75, 192, 192, 1);margin-right:5px;margin-left:10px;"></div> Data
                            <div style="width:25px;height:25px;background: rgba(75, 255, 192, 1);margin-right:5px;margin-left:10px;"></div> Prediction
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="pdl" class="w-100 h-auto"></canvas>
            </div>
        </div>
    </div>
    <script>
        const dlCtx = document.getElementById('dl');

        const labels = [
            @foreach($orderRecords as $item)
                {{$item['c_date']}},
            @endforeach
        ];

        const dataPoints = [
            @foreach($orderRecords as $item)
                {{$item['total']}},
            @endforeach
        ];

        const pointColors = dataPoints.map((_, index) => {
            return index === dataPoints.length - 1 ? 'rgba(75, 255, 192, 1)' : 'rgba(75, 192, 192, 1)';
        });

        const dailyChart = new Chart(dlCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Sales Record',
                    data: dataPoints,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    // pointBackgroundColor: pointColors, // Assign colors to each point
                    // pointBorderColor: pointColors, // Optionally, set border colors
                    backgroundColor: pointColors, // Area under the line
                    fill: true,
                    tension: 0.4 // Smooth line
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

<script>
    const pdlCtx = document.getElementById('pdl');

    const plabels = [
        @foreach($preOrderRecords as $item)
            {{$item['c_date']}},
        @endforeach
    ];

    const pdataPoints = [
        @foreach($preOrderRecords as $item)
            {{$item['total']}},
        @endforeach
    ];

    const ppointColors = pdataPoints.map((_, index) => {
        return index === pdataPoints.length - 1 ? 'rgba(75, 255, 192, 1)' : 'rgba(75, 192, 192, 1)';
    });

    const pdailyChart = new Chart(pdlCtx, {
        type: 'bar',
        data: {
            labels: plabels,
            datasets: [{
                label: 'Sales Record',
                data: pdataPoints,
                borderColor: 'rgba(75, 192, 192, 1)',
                // pointBackgroundColor: pointColors, // Assign colors to each point
                // pointBorderColor: pointColors, // Optionally, set border colors
                backgroundColor: ppointColors, // Area under the line
                fill: true,
                tension: 0.4 // Smooth line
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection
