@extends('layouts.app')


@section('content')
@push('head-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script>
        console.log('hello world')
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>

@endpush

    <div class="container">
        <h2 class="text-center py-4">
            Orders
        </h2>
        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>Reference No.</th>
                    <th>Date</th>
                    <th>Payment Mode</th>
                    <th>Status</th>
                    <th>Date Paid</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $item)
                    <tr>
                        <td>{{$item->ref}}</td>
                        <td>{{$item->created_at->format('m-d-y h:i a')}}</td>
                        <td>{{$item->mop}}</td>
                        <td>{{$item->status}}</td>
                        <td>{{$item->paid_at ?? '--'}}</td>
                        <td>PHP {{number_format($item->amount_payable, 2)}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
