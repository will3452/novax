@extends('layouts.app')


@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item active">Records</li>
    </ol>

    @if (auth()->user()->records()->count())
        <div class="row mb-2">
            <div class="col-md-3 col-6 ">
                <div class="card">
                    <div class="card-header text-center fw-bold">
                        Latest Result
                    </div>
                    <div class="card-body text-center ">
                        <div class="fs-2 fw-bold">
                            {{auth()->user()->records()->latest()->first()->result}}
                        </div>
                        <div>
                            {{auth()->user()->records()->latest()->first()->scale}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 ">
                <div class="card">
                    <div class="card-header text-center fw-bold">
                        Records
                    </div>
                    <div class="card-body text-center ">
                        <div class="fs-2 fw-bold">
                            {{auth()->user()->records()->count()}}
                        </div>
                        <div>
                            {{auth()->user()->records()->first()->created_at->format('M, Y')}} - {{auth()->user()->records()->latest()->first()->created_at->format('M, Y')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-2">
            <svg class="sparkline" width="300" height="70" stroke-width="2"></svg>
            <span id="sp-selected"></span>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>Records</div>
            <div>
                <add-record></add-record>
            </div>
        </div>
        <div class="card-body">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>
                            Date
                        </th>
                        <th>
                            Weight (kg)
                        </th>
                        <th>
                            Height (m)
                        </th>
                        <th>
                            Result
                        </th>
                        <th>
                            Scale
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                        <tr>
                            <td>
                                {{$record->created_at->format('m-d-y')}}
                            </td>
                            <td>
                                {{$record->weight}}
                            </td>
                            <td>
                                {{$record->height}}
                            </td>
                            <td>
                                {{$record->result}}
                            </td>
                            <td>
                                {{$record->scale}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('head')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    @endpush

    @push('body')

    <script >
        window.onload = function () {
            sparkline(document.querySelector(".sparkline"), [
                @foreach($records as $record)
                {date: "{{$record->created_at->format('m-d-Y')}}", value: {{ $record->result }} },
                @endforeach
            ], {
                spotRadius: 4,
                onmousemove: function (event, datapoint) {
                    document.querySelector("#sp-selected").innerHTML = `<span class="font-bold">RESULT: ${datapoint.value} | DATE: ${datapoint.date}</span>`;
                },
                onmouseout: function () {
                    document.querySelector("#sp-selected").innerHTML = ''
                }
            });
        }
    </script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#example').DataTable();
            });
        </script>
    @endpush

@endsection
