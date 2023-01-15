@extends('layouts.app')


@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item active">Activities</li>
    </ol>


    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>Activities</div>
        </div>
        <div class="card-body">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>
                            Date
                        </th>
                        <th>
                            Activity
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $a)
                        <tr>
                            <td>
                                {{$a->created_at->format('m-d-y')}}
                            </td>
                            <td>
                                {{$a->message()}}
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
