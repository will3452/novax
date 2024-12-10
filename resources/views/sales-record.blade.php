@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> <!-- Include the datalabels plugin -->
    <h1>Sales Record</h1>
    <div>
        {{$from}} - {{$to}}
    </div>
    <table class="w-100 border mt-4 table">
        <thead>
            <tr>
                <th class="border text-center">
                    Date
                </th>
                <th class="border text-center">
                    Sales
                </th>
                <th class="border text-center">
                    Sources
                </th>
                <th class="border text-center">
                    Total
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $item)
                <tr>
                    <td>
                        {{$item->created_at->format('m-d-Y')}}
                    </td>
                    <td>
                        {{$item->sales?->name ?? '---'}}
                    </td>
                    <td style="text-transform: lowercase">
                        {{$item->source}}
                    </td>
                    <td class="text-right">
                        PHP {{number_format($item->total, 2)}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        window.print()
    </script>
@endsection
