@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Predictions</h1>
            <a href="{{url()->previous()}}" class="btn btn-primary">Back to Management</a>
        </div>

        @if (isset($product))
            <div class="card">
                <div class="card-header">
                    Product Details
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <img class="w-100" src="/storage/{{$product->image}}" alt="">
                        </div>
                        <div class="col-8">
                            <div>
                                <h3>{{$product->name}}</h3>
                                <div>{{$product->description ?? 'No Description'}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="card mt-4">
            <div class="card-header">
                <div class="d-flex justify-content-between items-center">
                    <div>Chart</div>
                    <div>
                        <div class="d-flex">
                            <!-- <div style="width:25px;height:25px;background: rgba(75, 192, 192, 1);margin-right:5px;margin-left:10px;"></div> Data -->
                            <div style="width:25px;height:25px;background: red;margin-right:5px;margin-left:10px;border-radius:50%;"></div> Prediction
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
            return index === dataPoints.length - 1 ? 'red' : '#191970';
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
        return index === pdataPoints.length - 1 ? 'red' : 'rgba(75, 192, 192, 1)';
    });

    let mergedLabels = Array.from((new Set([...plabels, ...labels])))


    const pdailyChart = new Chart(pdlCtx, {
        type: 'line',
        data: {
            labels: mergedLabels,
            datasets: [{
                label: 'Pre Orders',
                data: pdataPoints,
                borderColor: 'rgba(75, 192, 192, 1)',
                // pointBackgroundColor: pointColors, // Assign colors to each point
                // pointBorderColor: pointColors, // Optionally, set border colors
                backgroundColor: ppointColors, // Area under the line
                fill: false,
                tension: 0.4 // Smooth line
            },
                {
                    label: 'Orders',
                    data: dataPoints,
                    borderColor: '#191970',
                    // pointBackgroundColor: pointColors, // Assign colors to each point
                    // pointBorderColor: pointColors, // Optionally, set border colors
                    backgroundColor: pointColors, // Area under the line
                    fill: false,
                    tension: 0.4 // Smooth line
                }
        ]
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
