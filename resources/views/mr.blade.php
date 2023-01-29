@extends('layouts.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
@endpush
    <div class="container">

    <h1>Message Requests</h1>
        <table id="example">
            <thead>
                <tr>
                    <th>
                        Date
                    </th>
                    <th>
                        Student
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mr as $item)
                    <tr>
                        <td>
                            {{$item->created_at->format('m/d/Y')}}
                        </td>
                        <td>
                            {{$item->user->name}}
                        </td>
                        <td>
                            <a href="/chat?user={{$item->user->id}}" class="btn btn-sm btn-primary">message</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
