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

    <h1>Conversations</h1>
        <table id="example">
            <thead>
                <tr>
                    <th>
                        Date
                    </th>
                    <th>
                        Conversations
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($conversation as $item)
                    <tr>
                        <td>
                            {{$item->created_at->format('m/d/Y')}}
                        </td>
                        <td>
                            @foreach (explode(\App\Models\Conversation::SP, $item->messages) as $i)
                                <p>
                                    <small>{{$i}}</small>
                                </p>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
