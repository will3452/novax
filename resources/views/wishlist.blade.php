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
            Wishlist
        </h2>
        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Product</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $item)
                    <tr>
                        <td>{{$item->created_at->format('m-d-y h:i a')}}</td>
                        <td>{{$item->product->name}}</td>
                        <td>
                            <a href="{{route('products.remove-to-wishlist',['product' => $item->product_id])}}" class="btn btn-danger btn-sm">remove</a>
                            <a href="{{route('products.show', ['product' => $item->product_id])}}" class="btn btn-sm btn-success">view</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
