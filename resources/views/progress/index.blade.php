@extends('layouts.app')
@section('content')

    <h1 class="text-center">Your Progress</h1>
    <div class="container">
        <div class="">
            {{-- <div class="card-header"></div> --}}
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <canvas id="myChart" width="600" height="400"></canvas>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Activity Logs
                        </div>
                        <div class="card-body">
                            <table class="table" id="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Date
                                        </th>
                                        <th>
                                            Details
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (auth()->user()->progress as $item)
                                    <tr>
                                        <td>
                                            {{$item->created_at->format('m-d-Y')}}
                                        </td>
                                        <td>
                                            {{$item->model_type == '\\App\\Models\\MealToday' ? 'Eat Remcommended Food' : 'Exercised'}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        const DATA_COUNT = 10;
        const labels = [
            @foreach(auth()->user()->bmis()->get() as $item)
                `{{$item->created_at}}`,
            @endforeach
        ];

        const config = {
        type: 'bar',
        data: {
            labels: [
                @foreach(auth()->user()->bmis()->get() as $item)
                `{{$item->created_at->format('m-d-Y')}}`,
                @endforeach
            ],
            datasets: [
                {
                    label:'BMI',
                    data: [
                        @foreach(auth()->user()->bmis()->get() as $item)
                        {{$item->result}},
                        @endforeach
                    ],
                    backgroundColor:'yellowgreen',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: false,
            plugins: {
            title: {
                display: true,
                text: 'Your BMI history'
            },
            },
            interaction: {
            intersect: false,
            },
            scales: {
            x: {
                display: true,
                title: {
                display: true
                }
            },
            y: {
                display: true,
                title: {
                display: true,
                text: 'Value'
                },
                suggestedMin: 0,
                suggestedMax: 40
            }
            }
        },
        };


        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx,config);
    </script>
@endsection
