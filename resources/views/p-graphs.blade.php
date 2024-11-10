@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Order Analytics</h1>
            <a href="/admin" class="btn btn-primary">Back to Management</a>
        </div>
        <div class="row g-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Daily Orders
                    </div>
                    <div class="card-body">
                        <canvas id="dl" >
                        </canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Monthly Orders
                    </div>
                    <div class="card-body">

                <canvas id="ml">
                </canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Yearly Orders
                    </div>
                    <div class="card-body">
                        <canvas id="yl" >
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const dlCtx = document.getElementById('dl');

        new Chart(dlCtx, {
            type: 'bar',
            data: {
                datasets: [
                    @foreach ($dailyUsage as $item)
                        {
                            label: '{{\App\Models\Product::find($item->product_id)->name}}',
                            data: [{
                                x: '{{$item->c_date}}', y: {{$item->total}},
                            }],
                            backgroundColor: ["{{ sprintf('#%06X', mt_rand(0, 0xffffff)) }}"]
                        },
                    @endforeach
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        })

        const mlCtx = document.getElementById('ml');

        new Chart(mlCtx, {
            type: 'bar',
            data: {
                datasets: [
                    @foreach ($monthlyUsage as $item)
                        {
                            label: '{{\App\Models\Product::find($item->product_id)->name}}',
                            data: [{
                                x: '{{$item->c_date}}', y: {{$item->total}},
                            }],
                            backgroundColor: ["{{ sprintf('#%06X', mt_rand(0, 0xffffff)) }}"]
                        },
                    @endforeach
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        })

        const ylCtx = document.getElementById('yl');

        new Chart(ylCtx, {
            type: 'bar',
            data: {
                datasets: [
                    @foreach ($yearlyUsage as $item)
                        {
                            label: '{{\App\Models\Product::find($item->product_id)->name}}',
                            data: [{
                                x: '{{$item->c_date}}', y: {{$item->total}},
                            }],
                            backgroundColor: ["{{ sprintf('#%06X', mt_rand(0, 0xffffff)) }}"]
                        },
                    @endforeach
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        })


    </script>
@endsection
